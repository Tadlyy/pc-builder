<?php

namespace App\Services;

use App\Models\Product;
use Database\Seeders\DigitecPriceSeeder;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DigitecSyncService
{
    private const BASE_URL = 'https://www.digitec.ch';

    private const SEARCH_URL = self::BASE_URL.'/de/search';

    /**
     * Modern browser headers to prevent Akamai / bot-block 403 errors.
     *
     * @var array<string, string>
     */
    private const HEADERS = [
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
        'Accept-Language' => 'de-CH,de;q=0.9,en-US;q=0.8,en;q=0.7',
        'Sec-Ch-Ua' => '"Not(A:Brand";v="99", "Google Chrome";v="133", "Chromium";v="133"',
        'Sec-Ch-Ua-Mobile' => '?0',
        'Sec-Ch-Ua-Platform' => '"Linux"',
        'Sec-Fetch-Dest' => 'document',
        'Sec-Fetch-Mode' => 'navigate',
        'Sec-Fetch-Site' => 'none',
        'Sec-Fetch-User' => '?1',
        'Upgrade-Insecure-Requests' => '1',
    ];

    private const USER_AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36';

    /**
     * Synchronise a single product with Digitec.
     *
     * @return array{status: string, product_id: int, product_name: string, old_url: ?string, new_url: ?string, old_price: ?float, new_price: ?float, message: ?string}
     */
    public function syncProduct(Product $product): array
    {
        $oldUrl = $product->url;
        $oldPrice = $product->price;

        try {
            // ------------------------------------------------------------------
            // Step A – Check existing URL or resolve canonical product URL
            // ------------------------------------------------------------------
            $productUrl = $this->resolveProductUrl($product);

            if ($productUrl === null) {
                // If the product explicitly had a dead link or search link that couldn't be resolved
                // check if it's explicitly 404
                if (filled($product->url) && $this->isCanonicalProductUrl($product->url)) {
                    $testResp = $this->httpGet($product->url);
                    if ($testResp->notFound() || ! $this->isValidDigitecProductResponse($testResp, $product->name)) {
                        return $this->deleteProduct($product, $oldUrl, $oldPrice);
                    }
                }

                // If not confirmed 404, do not delete to protect the catalog
                return $this->deleteProduct($product, $oldUrl, $oldPrice);
            }

            // ------------------------------------------------------------------
            // Step B – Fetch product page and verify it is genuine IT hardware
            // ------------------------------------------------------------------
            $response = $this->httpGet($productUrl);

            if ($response->notFound()) {
                return $this->deleteProduct($product, $oldUrl, $oldPrice);
            }

            // Non-success responses that are NOT 404 (e.g. 403, 429, 500) → never delete!
            if (! $response->successful()) {
                if ($this->isBlockedResponse($response)) {
                    $catalogItem = $this->findCatalogItem($product->name, $product->id);
                    if ($catalogItem !== null) {
                        $product->url = $catalogItem['url'];
                        $product->price = $catalogItem['price'];
                        $product->save();

                        return [
                            'status' => 'updated',
                            'product_id' => $product->id,
                            'product_name' => $product->name,
                            'old_url' => $oldUrl,
                            'new_url' => $product->url,
                            'old_price' => $oldPrice,
                            'new_price' => $product->price,
                            'message' => 'Aktualisiert über verifizierten Hardware-Katalog (Live-Abruf von Digitec geschützt)',
                        ];
                    }
                }

                return $this->errorResult(
                    $product,
                    $oldUrl,
                    $oldPrice,
                    "Digitec antwortete mit HTTP {$response->status()} für {$productUrl}"
                );
            }

            // Verify that the response is genuinely from Digitec (IT sector) and not Galaxus shoes/clothes
            if (! $this->isValidDigitecProductResponse($response, $product->name)) {
                Log::info('DigitecSync: Link führt nicht zu Digitec-Hardware (z.B. Galaxus-Schuh-Redirect)', [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'final_uri' => (string) $response->effectiveUri(),
                ]);

                return $this->deleteProduct($product, $oldUrl, $oldPrice);
            }

            // ------------------------------------------------------------------
            // Step C – Extract price and update product
            // ------------------------------------------------------------------
            $price = $this->extractPrice($response->body());
            $finalUrl = (string) $response->effectiveUri();

            $product->url = $this->cleanUrl($finalUrl);

            if ($price !== null && $price > 0) {
                $product->price = $price;
            }

            $product->save();

            return [
                'status' => 'updated',
                'product_id' => $product->id,
                'product_name' => $product->name,
                'old_url' => $oldUrl,
                'new_url' => $product->url,
                'old_price' => $oldPrice,
                'new_price' => $product->price,
                'message' => null,
            ];
        } catch (ConnectionException $e) {
            $catalogItem = $this->findCatalogItem($product->name, $product->id);
            if ($catalogItem !== null) {
                $product->url = $catalogItem['url'];
                $product->price = $catalogItem['price'];
                $product->save();

                return [
                    'status' => 'updated',
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'old_url' => $oldUrl,
                    'new_url' => $product->url,
                    'old_price' => $oldPrice,
                    'new_price' => $product->price,
                    'message' => 'Aktualisiert über verifizierten Hardware-Katalog (Live-Abruf von Digitec geschützt oder offline)',
                ];
            }

            // Network failure or rate limit on unknown product → never delete, always error
            return $this->errorResult($product, $oldUrl, $oldPrice, "Verbindungsfehler: {$e->getMessage()}");
        } catch (\Throwable $e) {
            Log::error('DigitecSync: unerwarteter Fehler', [
                'product_id' => $product->id,
                'exception' => $e->getMessage(),
            ]);

            return $this->errorResult($product, $oldUrl, $oldPrice, "Unerwarteter Fehler: {$e->getMessage()}");
        }
    }

    /**
     * Synchronise all products sequentially.
     *
     * @return array{updated: int, deleted: int, errors: int, details: list<array>}
     */
    public function syncAll(): array
    {
        $products = Product::all();
        $results = ['updated' => 0, 'deleted' => 0, 'errors' => 0, 'details' => []];

        foreach ($products as $product) {
            $result = $this->syncProduct($product);
            $results['details'][] = $result;

            match ($result['status']) {
                'updated' => $results['updated']++,
                'deleted' => $results['deleted']++,
                default => $results['errors']++,
            };

            // Throttle requests against rate limits (0.5–1 second pause)
            usleep(random_int(500_000, 1_000_000));
        }

        return $results;
    }

    /**
     * Check if a response is genuinely a Digitec IT hardware product page.
     * Prevents keeping dead Digitec links that redirect to Galaxus (shoes, clothes, napkins, etc.).
     */
    private function isValidDigitecProductResponse(Response $response, string $productName): bool
    {
        if (! $response->successful()) {
            return false;
        }

        $effectiveUri = (string) $response->effectiveUri();
        $host = parse_url($effectiveUri, PHP_URL_HOST);
        $path = parse_url($effectiveUri, PHP_URL_PATH) ?? '';

        // 1. Host must be digitec.ch, not galaxus.ch
        if ($host !== 'www.digitec.ch' && $host !== 'digitec.ch') {
            return false;
        }

        // 2. Sector must be s1 (IT / electronics), not s8 (fashion/shoes), s3 (sports), s14 (home)
        if (! str_contains($path, '/s1/product/')) {
            return false;
        }

        // 3. Keyword verification: The URL slug must match at least one significant product keyword
        $stopWords = ['amd', 'intel', 'pro', 'max', 'plus', 'the', 'and', 'for', 'mit', 'und', 'edition', 'gaming', 'wifi'];
        $keywords = array_filter(
            explode(' ', mb_strtolower($productName)),
            fn (string $w): bool => mb_strlen($w) >= 3 && ! in_array($w, $stopWords, true)
        );

        $pathLower = mb_strtolower(urldecode($path));

        if (! empty($keywords)) {
            $matched = false;
            foreach ($keywords as $kw) {
                if (str_contains($pathLower, $kw)) {
                    $matched = true;
                    break;
                }
            }

            if (! $matched) {
                return false;
            }
        }

        return true;
    }

    /**
     * Resolve the canonical product URL:
     * 1. If existing URL is a direct product link (/s1/product/), verify it.
     * 2. If existing URL is missing or a search link, check verified catalog mapping.
     * 3. Fallback to Digitec search.
     */
    private function resolveProductUrl(Product $product): ?string
    {
        // 1. Check if existing URL is already a canonical product link
        if ($this->isCanonicalProductUrl($product->url)) {
            $response = $this->httpGet($product->url);

            if ($this->isBlockedResponse($response)) {
                $catalogItem = $this->findCatalogItem($product->name, $product->id);
                if ($catalogItem !== null) {
                    return $catalogItem['url'];
                }

                throw new ConnectionException(
                    "Digitec blockierte die Anfrage (HTTP {$response->status()}) – Produkt wird nicht verändert."
                );
            }

            if ($this->isValidDigitecProductResponse($response, $product->name)) {
                return (string) $response->effectiveUri();
            }
        }

        // 2. Look up in verified hardware catalog mapping
        $catalogItem = $this->findCatalogItem($product->name, $product->id);
        if ($catalogItem !== null && $this->isCanonicalProductUrl($catalogItem['url'])) {
            $response = $this->httpGet($catalogItem['url']);

            if ($this->isBlockedResponse($response)) {
                return $catalogItem['url'];
            }

            if ($this->isValidDigitecProductResponse($response, $product->name)) {
                return (string) $response->effectiveUri();
            }
        }

        // 3. Search Digitec directly by name
        return $this->searchProduct($product->name);
    }

    /**
     * Check if a URL is a direct product page link (/s1/product/).
     */
    private function isCanonicalProductUrl(?string $url): bool
    {
        if (blank($url) || ! $this->isValidDigitecUrl($url)) {
            return false;
        }

        return str_contains($url, '/s1/product/');
    }

    /**
     * Search Digitec for a product by name and return the canonical URL of the best match.
     */
    private function searchProduct(string $productName): ?string
    {
        $searchUrl = self::SEARCH_URL.'?q='.urlencode($productName);
        $response = $this->httpGet($searchUrl);

        if ($this->isBlockedResponse($response)) {
            $catalogItem = $this->findCatalogItem($productName);
            if ($catalogItem !== null) {
                return $catalogItem['url'];
            }

            throw new ConnectionException(
                "Digitec-Suche blockiert (HTTP {$response->status()}) – Produkt wird nicht verändert."
            );
        }

        if (! $response->successful()) {
            throw new ConnectionException(
                "Digitec-Suche fehlgeschlagen (HTTP {$response->status()}) – Produkt wird nicht verändert."
            );
        }

        $html = $response->body();

        return $this->extractBestMatchUrl($html, $productName);
    }

    /**
     * Look up product from pre-seeded hardware catalog if available.
     *
     * @return array{price: float, url: string, name?: string}|null
     */
    private function findCatalogItem(string $name, ?int $id = null): ?array
    {
        if (! class_exists(DigitecPriceSeeder::class)) {
            return null;
        }

        try {
            $catalog = DigitecPriceSeeder::digitecData();
            $normalizedName = mb_strtolower(trim($name));
            $cleanNameAlpha = preg_replace('/[^a-z0-9]/', '', $normalizedName) ?? '';

            // 1. Direct name match
            foreach ($catalog as $item) {
                if (isset($item['name']) && mb_strtolower(trim($item['name'])) === $normalizedName) {
                    return $item;
                }
            }

            // 2. Alphanumeric stripped match
            if ($cleanNameAlpha !== '') {
                foreach ($catalog as $item) {
                    if (isset($item['name'])) {
                        $itemAlpha = preg_replace('/[^a-z0-9]/', '', mb_strtolower(trim($item['name']))) ?? '';
                        if ($itemAlpha === $cleanNameAlpha) {
                            return $item;
                        }
                    }
                }
            }

            // 3. ID match with token safety check
            if ($id !== null && isset($catalog[$id])) {
                $candidate = $catalog[$id];
                $candidateAlpha = preg_replace('/[^a-z0-9]/', '', mb_strtolower(trim($candidate['name'] ?? ''))) ?? '';
                if ($candidateAlpha !== '' && $cleanNameAlpha !== '') {
                    if ($candidateAlpha === $cleanNameAlpha || str_contains($candidateAlpha, $cleanNameAlpha) || str_contains($cleanNameAlpha, $candidateAlpha)) {
                        return $candidate;
                    }
                }
            }
        } catch (\Throwable) {
            // Ignore catalog reflection errors
        }

        return null;
    }

    /**
     * Extract the best matching canonical product URL from search results or page HTML.
     */
    private function extractBestMatchUrl(string $html, string $searchTerm): ?string
    {
        preg_match_all('#href="(/de/s1/product/[^"]+|/en/s1/product/[^"]+)"#i', $html, $matches);

        if (empty($matches[1])) {
            preg_match_all('#"(/(?:de|en)/s1/product/[^"]+)"#i', $html, $matches);
        }

        if (empty($matches[1])) {
            return null;
        }

        $searchWords = array_filter(
            explode(' ', mb_strtolower($searchTerm)),
            fn (string $word): bool => mb_strlen($word) > 2
        );

        $bestUrl = null;
        $bestScore = -1;

        foreach (array_unique($matches[1]) as $path) {
            $normalizedPath = mb_strtolower(urldecode($path));
            $score = 0;

            foreach ($searchWords as $word) {
                if (str_contains($normalizedPath, $word)) {
                    $score++;
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestUrl = self::BASE_URL.$path;
            }
        }

        if ($bestScore < 1) {
            return null;
        }

        return $bestUrl;
    }

    /**
     * Extract the CHF price using:
     * 1. Schema.org application/ld+json (offers.price)
     * 2. OpenGraph meta tag (product:price:amount)
     * 3. Next.js state (fallbackPrice.amountInclusive)
     */
    private function extractPrice(string $html): ?float
    {
        // Priority 1: application/ld+json
        preg_match_all('#<script\s+type="application/ld\+json"[^>]*>(.*?)</script>#si', $html, $matches);

        foreach ($matches[1] ?? [] as $jsonBlock) {
            $data = json_decode(trim($jsonBlock), true);

            if (! is_array($data)) {
                continue;
            }

            $price = $this->findPriceInLdJson($data);

            if ($price !== null) {
                return $price;
            }
        }

        // Priority 2: <meta property="product:price:amount" content="219.00">
        if (preg_match('#<meta\s+property="product:price:amount"\s+content="([0-9.]+)"#i', $html, $metaMatch)) {
            $val = (float) $metaMatch[1];
            if ($val > 0) {
                return $val;
            }
        }

        // Priority 3: Next.js state fallbackPrice
        if (preg_match('#"fallbackPrice"\s*:\s*\{"amountInclusive"\s*:\s*([0-9.]+)\s*,\s*"currency"\s*:\s*"CHF"\}#i', $html, $nextMatch)) {
            $val = (float) $nextMatch[1];
            if ($val > 0) {
                return $val;
            }
        }

        return null;
    }

    /**
     * Recursively search ld+json data for an offers.price value in CHF.
     */
    private function findPriceInLdJson(array $data): ?float
    {
        if (isset($data['offers'])) {
            $offers = $data['offers'];

            if (isset($offers['price'])) {
                return $this->parseCurrency($offers);
            }

            if (isset($offers[0]['price'])) {
                return $this->parseCurrency($offers[0]);
            }
        }

        if (isset($data['@graph']) && is_array($data['@graph'])) {
            foreach ($data['@graph'] as $node) {
                if (is_array($node)) {
                    $price = $this->findPriceInLdJson($node);

                    if ($price !== null) {
                        return $price;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Parse price value from an offer node, preferring CHF.
     */
    private function parseCurrency(array $offer): ?float
    {
        $currency = $offer['priceCurrency'] ?? 'CHF';

        if (mb_strtoupper($currency) !== 'CHF') {
            return null;
        }

        $price = $offer['price'] ?? null;

        if ($price === null) {
            return null;
        }

        return (float) $price;
    }

    /**
     * Remove query strings and fragments from a Digitec URL.
     */
    private function cleanUrl(string $url): string
    {
        $parsed = parse_url($url);

        return ($parsed['scheme'] ?? 'https').'://'.($parsed['host'] ?? 'www.digitec.ch').($parsed['path'] ?? '');
    }

    /**
     * Validate that a URL points to digitec.ch.
     */
    private function isValidDigitecUrl(string $url): bool
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);

        return $host !== null && Str::endsWith($host, 'digitec.ch');
    }

    /**
     * Check whether a response indicates bot blocking or rate limiting.
     */
    private function isBlockedResponse(Response $response): bool
    {
        return in_array($response->status(), [403, 429], true);
    }

    /**
     * Perform an HTTP GET using HTTP/2 and realistic browser headers.
     */
    private function httpGet(string $url): Response
    {
        return Http::withHeaders(self::HEADERS)
            ->withUserAgent(self::USER_AGENT)
            ->withOptions([
                'version' => 2.0,
            ])
            ->connectTimeout(5)
            ->timeout(15)
            ->get($url);
    }

    /**
     * Delete a product that is confirmed not to exist on Digitec.
     *
     * @return array{status: string, product_id: int, product_name: string, old_url: ?string, new_url: null, old_price: ?float, new_price: null, message: string}
     */
    private function deleteProduct(Product $product, ?string $oldUrl, ?float $oldPrice): array
    {
        $id = $product->id;
        $name = $product->name;

        // Detach all build relations before deleting
        $product->builds()->detach();
        $product->delete();

        Log::info('DigitecSync: Produkt gelöscht (existiert nicht auf Digitec)', [
            'product_id' => $id,
            'product_name' => $name,
        ]);

        return [
            'status' => 'deleted',
            'product_id' => $id,
            'product_name' => $name,
            'old_url' => $oldUrl,
            'new_url' => null,
            'old_price' => $oldPrice,
            'new_price' => null,
            'message' => "Produkt '{$name}' existiert nicht auf Digitec und wurde aus der Datenbank gelöscht.",
        ];
    }

    /**
     * Return a structured error result without modifying the product.
     *
     * @return array{status: string, product_id: int, product_name: string, old_url: ?string, new_url: ?string, old_price: ?float, new_price: ?float, message: string}
     */
    private function errorResult(Product $product, ?string $oldUrl, ?float $oldPrice, string $message): array
    {
        Log::warning('DigitecSync: Fehler', [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'error' => $message,
        ]);

        return [
            'status' => 'error',
            'product_id' => $product->id,
            'product_name' => $product->name,
            'old_url' => $oldUrl,
            'new_url' => $product->url,
            'old_price' => $oldPrice,
            'new_price' => $product->price,
            'message' => $message,
        ];
    }
}

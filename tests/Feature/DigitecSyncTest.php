<?php

namespace Tests\Feature;

use App\Models\Build;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DigitecSyncTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->admin()->create();
        $this->category = Category::factory()->create();
    }

    public function test_api_sync_endpoints_require_authentication(): void
    {
        $product = Product::factory()->create(['category_id' => $this->category->id]);

        $this->postJson("/api/digitec/sync/{$product->id}")
            ->assertUnauthorized();

        $this->postJson('/api/digitec/sync-all')
            ->assertUnauthorized();
    }

    public function test_api_sync_updates_product_with_canonical_url_and_price(): void
    {
        Sanctum::actingAs($this->user);

        $product = Product::factory()->create([
            'category_id' => $this->category->id,
            'name' => 'Test Hardware',
            'price' => 100.00,
            'url' => 'https://www.digitec.ch/de/s1/product/test-hardware-12345',
        ]);

        $fakeHtml = <<<'HTML'
        <!DOCTYPE html>
        <html>
        <head>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Product",
                "name": "Test Hardware",
                "offers": {
                    "@type": "Offer",
                    "price": 89.90,
                    "priceCurrency": "CHF"
                }
            }
            </script>
        </head>
        <body></body>
        </html>
        HTML;

        Http::fake([
            'https://www.digitec.ch/de/s1/product/test-hardware-12345*' => Http::response($fakeHtml, 200),
        ]);

        $response = $this->postJson("/api/digitec/sync/{$product->id}");

        $response->assertOk()
            ->assertJson([
                'status' => 'updated',
                'product_id' => $product->id,
                'new_price' => 89.90,
                'new_url' => 'https://www.digitec.ch/de/s1/product/test-hardware-12345',
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 89.90,
        ]);
    }

    public function test_api_sync_deletes_product_when_it_does_not_exist_on_digitec(): void
    {
        Sanctum::actingAs($this->user);

        $product = Product::factory()->create([
            'category_id' => $this->category->id,
            'name' => 'Obsolescent Part',
            'url' => 'https://www.digitec.ch/de/s1/product/obsolescent-part-99999',
        ]);

        $build = Build::factory()->create();
        $build->products()->attach($product->id, ['quantity' => 1]);

        Http::fake([
            'https://www.digitec.ch/de/s1/product/obsolescent-part-99999*' => Http::response('Not Found', 404),
            'https://www.digitec.ch/de/search*' => Http::response('<html><body>Keine Treffer</body></html>', 200),
        ]);

        $response = $this->postJson("/api/digitec/sync/{$product->id}");

        $response->assertOk()
            ->assertJson([
                'status' => 'deleted',
                'product_id' => $product->id,
            ]);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertDatabaseMissing('build_product', ['product_id' => $product->id]);
    }

    public function test_api_sync_does_not_delete_product_on_http_403_or_rate_limit(): void
    {
        Sanctum::actingAs($this->user);

        $product = Product::factory()->create([
            'category_id' => $this->category->id,
            'name' => 'Protected Part',
            'price' => 200.00,
            'url' => 'https://www.digitec.ch/de/s1/product/protected-part-11111',
        ]);

        Http::fake([
            'https://www.digitec.ch/*' => Http::response('Forbidden', 403),
        ]);

        $response = $this->postJson("/api/digitec/sync/{$product->id}");

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'product_id' => $product->id,
            ]);

        // Must still exist in database unchanged!
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 200.00,
        ]);
    }

    public function test_sync_all_endpoint_returns_structured_summary(): void
    {
        Sanctum::actingAs($this->user);

        Product::factory()->create([
            'category_id' => $this->category->id,
            'name' => 'Part 1',
            'url' => 'https://www.digitec.ch/de/s1/product/part-1',
        ]);

        $fakeHtml = <<<'HTML'
        <!DOCTYPE html>
        <html><head>
            <meta property="product:price:amount" content="49.50">
            <meta property="product:price:currency" content="CHF">
        </head><body></body></html>
        HTML;

        Http::fake([
            'https://www.digitec.ch/de/s1/product/part-1*' => Http::response($fakeHtml, 200),
        ]);

        $response = $this->postJson('/api/digitec/sync-all');

        $response->assertOk()
            ->assertJsonStructure([
                'message',
                'summary' => ['updated', 'deleted', 'errors'],
                'details',
            ]);
    }
}

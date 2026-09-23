<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CompatibilityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ConfiguratorController extends Controller
{
    private const SESSION_KEY = 'configurator.products';

    public function __construct(private readonly CompatibilityService $compatibility) {}

    public function index(): View
    {
        $selected = $this->selectedProducts();
        $checked = $this->compatibility->validate($selected);

        $categories = Category::with('products')->orderBy('id')->get();

        $compatibleById = [];
        foreach ($categories as $category) {
            foreach ($category->products as $product) {
                $compatibleById[$product->id] = $this->compatibility->checkAdd($selected, $product)['allowed'];
            }
        }

        return view('configurator.index', [
            'categories' => $categories,
            'selected' => $selected,
            'checked' => $checked,
            'compatibleById' => $compatibleById,
            'totalPrice' => $this->totalPrice($selected),
        ]);
    }

    public function add(Product $product): RedirectResponse
    {
        $selected = $this->selectedProducts();
        $result = $this->compatibility->checkAdd($selected, $product);

        if (! $result['allowed']) {
            return redirect()
                ->route('configurator.index')
                ->with('error', implode(' ', $result['issues']));
        }

        $productIds = $selected
            ->reject(fn (Product $p): bool => $p->category_id === $product->category_id)
            ->pluck('id')
            ->push($product->id)
            ->unique()
            ->values()
            ->all();

        Session::put(self::SESSION_KEY, $productIds);

        $message = $result['replaced']
            ? $product->name.' wurde ersetzt.'
            : $product->name.' wurde zum Build hinzugefügt.';

        return redirect()->route('configurator.index')->with('success', $message);
    }

    public function remove(Product $product): RedirectResponse
    {
        $productIds = $this->selectedProducts()
            ->reject(fn (Product $p): bool => $p->id === $product->id)
            ->pluck('id')
            ->values()
            ->all();

        Session::put(self::SESSION_KEY, $productIds);

        return redirect()->route('configurator.index')->with('success', $product->name.' wurde entfernt.');
    }

    public function clear(): RedirectResponse
    {
        Session::forget(self::SESSION_KEY);

        return redirect()->route('configurator.index')->with('success', 'Der Konfigurator wurde geleert.');
    }

    /**
     * @return Collection<int, Product>
     */
    private function selectedProducts(): Collection
    {
        $ids = (array) Session::get(self::SESSION_KEY, []);

        if ($ids === []) {
            return new Collection;
        }

        $order = array_flip(array_map('intval', $ids));

        return Product::query()
            ->with('category')
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn (Product $product): int => $order[$product->id] ?? PHP_INT_MAX)
            ->values();
    }

    /**
     * @param  Collection<int, Product>  $selected
     */
    private function totalPrice(Collection $selected): float
    {
        return (float) $selected->sum('price');
    }
}

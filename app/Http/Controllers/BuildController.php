<?php

namespace App\Http\Controllers;

use App\Models\Build;
use App\Models\Product;
use App\Services\CompatibilityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class BuildController extends Controller
{
    public function __construct(private readonly CompatibilityService $compatibility) {}

    public function public(): View
    {
        $builds = Build::query()
            ->where('is_public', true)
            ->with(['user', 'products.category'])
            ->latest()
            ->get();

        return view('builds.public', compact('builds'));
    }

    public function shared(string $token): View
    {
        $build = Build::query()
            ->where('share_token', $token)
            ->with(['user', 'products.category'])
            ->firstOrFail();

        $checked = $this->compatibility->validate($build->products);

        return view('builds.show', [
            'build' => $build,
            'shared' => true,
            'checked' => $checked,
        ]);
    }

    public function show(Build $build): View
    {
        $build->load(['user', 'products.category']);

        Gate::authorize('view', $build);

        $checked = $this->compatibility->validate($build->products);

        return view('builds.show', [
            'build' => $build,
            'shared' => false,
            'checked' => $checked,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $productIds = $this->sessionProductIds();

        if ($productIds === []) {
            return redirect()->route('configurator.index')->with('error', 'Der Konfigurator ist leer.');
        }

        $products = Product::with('category')->whereIn('id', $productIds)->get();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $build = Build::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'total_price' => (float) $products->sum('price'),
        ]);

        foreach ($products as $product) {
            $build->products()->attach($product->id, ['quantity' => 1]);
        }

        Session::forget('configurator.products');

        return redirect()->route('dashboard')->with('success', 'Build "'.$build->title.'" wurde gespeichert.');
    }

    public function share(Build $build): RedirectResponse
    {
        Gate::authorize('update', $build);

        $build->setPublicShareToken();

        return redirect()
            ->route('builds.show', $build)
            ->with('share_url', route('builds.shared', $build->share_token));
    }

    public function destroy(Build $build): RedirectResponse
    {
        Gate::authorize('delete', $build);

        $build->delete();

        return redirect()->route('dashboard')->with('success', 'Build gelöscht.');
    }

    /**
     * @return array<int, int>
     */
    private function sessionProductIds(): array
    {
        return array_map('intval', (array) Session::get('configurator.products', []));
    }
}

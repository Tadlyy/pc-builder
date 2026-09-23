<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with('category')
            ->orderBy('category_id')
            ->orderBy('price')
            ->get();

        $categories = Category::orderBy('id')->withCount('products')->get();

        return view('catalog.index', compact('products', 'categories'));
    }

    public function show(Category $category): View
    {
        $products = $category
            ->products()
            ->orderBy('price')
            ->get();

        return view('catalog.show', compact('category', 'products'));
    }
}

@extends('layouts.app')

@section('title', 'Hardware-Katalog')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Hardware-Katalog</h1>
            <p class="mt-1 text-sm text-gray-600">{{ $products->count() }} Produkte, geladen mit <code class="rounded bg-gray-200 px-1 text-blue-700">Product::with('category')</code> – kein N+1 Problem.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('catalog.index') }}"
                class="rounded-lg border border-blue-500 bg-blue-500/10 px-3 py-1.5 text-sm font-medium text-blue-700 hover:bg-blue-500/20 transition">
                Alle
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('catalog.category', $category) }}"
                    class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm text-gray-700 hover:border-blue-500 hover:text-blue-700 transition">
                    {{ $category->name }} ({{ $category->products_count }})
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <x-product-card :product="$product">
                <form method="POST" action="{{ route('configurator.add', $product) }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 transition hover:bg-blue-500 hover:text-white">
                        Zum Build hinzufügen
                    </button>
                </form>
            </x-product-card>
        @endforeach
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Hardware-Katalog')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Hardware-Katalog</h1>
            <p class="mt-1 text-sm text-slate-400">{{ $products->count() }} Produkte, geladen mit <code class="rounded bg-slate-800 px-1 text-cyan-300">Product::with('category')</code> – kein N+1 Problem.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('catalog.index') }}"
                class="rounded-lg border border-cyan-500 bg-cyan-500/10 px-3 py-1.5 text-sm font-medium text-cyan-300 hover:bg-cyan-500/20 transition">
                Alle
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('catalog.category', $category) }}"
                    class="rounded-lg border border-slate-700 px-3 py-1.5 text-sm text-slate-300 hover:border-cyan-500 hover:text-cyan-300 transition">
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
                        class="w-full rounded-lg bg-slate-800 px-4 py-2 text-sm font-medium text-slate-200 transition hover:bg-cyan-500 hover:text-slate-900">
                        Zum Build hinzufügen
                    </button>
                </form>
            </x-product-card>
        @endforeach
    </div>
@endsection
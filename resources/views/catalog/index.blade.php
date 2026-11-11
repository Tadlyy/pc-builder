@extends('layouts.app')

@section('title', 'Hardware-Katalog')

@section('content')
    <div class="animate-fade-in-up space-y-6">
        <!-- Header & Category Pills -->
        <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-[#0071e3] dark:text-[#2997ff]">Komponenten-Bibliothek</span>
                <h1 class="mt-1 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">Hardware-Katalog</h1>
                <p class="mt-1.5 text-sm text-[#86868b] dark:text-[#a1a1a6]">
                    {{ $products->count() }} geprüfte Komponenten · Sofort kompatibel für deinen nächsten PC
                </p>
            </div>

            <!-- Category Filter Pills -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('catalog.index') }}"
                    class="rounded-full bg-[#1d1d1f] dark:bg-white px-4 py-2 text-xs font-semibold text-white dark:text-[#1d1d1f] shadow-sm transition active:scale-95">
                    Alle ({{ $products->count() }})
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('catalog.category', $category) }}"
                        class="rounded-full border border-black/[0.08] dark:border-white/[0.1] bg-white dark:bg-[#161618] px-3.5 py-2 text-xs font-medium text-[#6e6e73] dark:text-[#a1a1a6] hover:border-black/[0.2] dark:hover:border-white/[0.2] hover:text-[#1d1d1f] dark:hover:text-[#f5f5f7] transition active:scale-95 shadow-[0_1px_2px_rgba(0,0,0,0.02)]">
                        {{ $category->name }} ({{ $category->products_count }})
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <x-product-card :product="$product">
                    <form method="POST" action="{{ route('configurator.add', $product) }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-full bg-black/[0.05] dark:bg-white/[0.08] hover:bg-[#1d1d1f] hover:text-white dark:hover:bg-white dark:hover:text-[#1d1d1f] px-4 py-2.5 text-xs font-semibold text-[#1d1d1f] dark:text-[#f5f5f7] transition-all duration-200 active:scale-95">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Zum Build hinzufügen</span>
                        </button>
                    </form>
                </x-product-card>
            @endforeach
        </div>
    </div>
@endsection

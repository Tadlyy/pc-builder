@extends('layouts.app')

@section('title', $category->name.' – Katalog')

@section('content')
    <div class="animate-fade-in-up space-y-6">
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <nav class="flex items-center gap-2 text-xs text-[#86868b] dark:text-[#a1a1a6]">
                    <a href="{{ route('catalog.index') }}" class="hover:text-[#1d1d1f] dark:hover:text-[#f5f5f7] transition">Katalog</a>
                    <span class="text-black/[0.2] dark:text-white/[0.2]">/</span>
                    <span class="font-medium text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $category->name }}</span>
                </nav>
                <h1 class="mt-2 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $category->name }}</h1>
                <p class="mt-1.5 text-sm text-[#86868b] dark:text-[#a1a1a6]">{{ $products->count() }} kompatible Modelle verfügbar</p>
            </div>

            <div>
                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center gap-1.5 rounded-full border border-black/[0.08] dark:border-white/[0.1] bg-white dark:bg-[#161618] px-4 py-2 text-xs font-semibold text-[#1d1d1f] dark:text-[#f5f5f7] hover:bg-zinc-50 dark:hover:bg-zinc-800 transition active:scale-95 shadow-sm">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Zurück zur Übersicht</span>
                </a>
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

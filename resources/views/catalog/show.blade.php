@extends('layouts.app')

@section('title', $category->name.' – Katalog')

@section('content')
    <div class="animate-fade-in-up space-y-6">
        <!-- Header & Breadcrumbs -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <nav class="flex items-center gap-2 text-xs text-[#86868b]">
                    <a href="{{ route('catalog.index') }}" class="hover:text-[#1d1d1f] transition">Katalog</a>
                    <span class="text-black/[0.2]">/</span>
                    <span class="font-medium text-[#1d1d1f]">{{ $category->name }}</span>
                </nav>
                <h1 class="mt-2 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f]">{{ $category->name }}</h1>
                <p class="mt-1.5 text-sm text-[#86868b]">{{ $products->count() }} kompatible Modelle verfügbar</p>
            </div>

            <div>
                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center gap-1.5 rounded-full border border-black/[0.08] bg-white px-4 py-2 text-xs font-semibold text-[#1d1d1f] hover:bg-zinc-50 transition active:scale-95 shadow-sm">
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
                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-full bg-black/[0.05] hover:bg-[#1d1d1f] hover:text-white px-4 py-2.5 text-xs font-semibold text-[#1d1d1f] transition-all duration-200 active:scale-95">
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

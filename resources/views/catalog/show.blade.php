@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <nav class="text-sm text-slate-400">
                <a href="{{ route('catalog.index') }}" class="hover:text-cyan-300">Katalog</a>
                <span class="mx-2">/</span>
                <span class="text-slate-200">{{ $category->name }}</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold">{{ $category->name }}</h1>
            <p class="mt-1 text-sm text-slate-400">{{ $products->count() }} verfügbare Modelle</p>
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
@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <nav class="text-sm text-gray-600">
                <a href="{{ route('catalog.index') }}" class="hover:text-blue-700">Katalog</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $category->name }}</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold">{{ $category->name }}</h1>
            <p class="mt-1 text-sm text-gray-600">{{ $products->count() }} verfügbare Modelle</p>
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
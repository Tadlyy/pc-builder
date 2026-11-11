@extends('layouts.app')

@section('title', 'PC Builder Konfigurator')

@section('content')
    <section class="grid gap-8 lg:grid-cols-2 lg:items-center animate-fade-in-up">
        <div>
            <p class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-100/50 px-3 py-1 text-xs font-medium text-blue-700">
                Laravel · Eloquent ORM · Blade · Tailwind CSS
            </p>
            <h1 class="mt-6 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Baue deinen
                <span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">perfekten PC</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                Geführter Schritt-für-Schritt Konfigurator mit automatischer Kompatibilitätsprüfung.
                Sockel, Formfaktor, RAM-Typ und Wattzahl – alles wird in Echtzeit validiert.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('configurator.index') }}"
                    class="rounded-xl bg-blue-500 px-6 py-3 font-semibold text-white shadow-lg shadow-blue-500/25 hover:bg-blue-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                    Konfiguration starten
                </a>
                <a href="{{ route('catalog.index') }}"
                    class="rounded-xl border border-gray-300 px-6 py-3 font-semibold text-gray-800 hover:bg-gray-200 transition">
                    Hardware-Katalog ansehen
                </a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 animate-fade-in-up" style="animation-delay: 100ms;">
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-3xl font-bold text-blue-600">7</p>
                <p class="mt-1 text-sm text-gray-600">Komponenten-Kategorien</p>
            </div>
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-3xl font-bold text-blue-600">100%</p>
                <p class="mt-1 text-sm text-gray-600">Kompatibilitäts-Garantie</p>
            </div>
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-3xl font-bold text-blue-600">AM5 · LGA1700</p>
                <p class="mt-1 text-sm text-gray-600">Sockel-Validierung im Backend</p>
            </div>
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-3xl font-bold text-blue-600">∞</p>
                <p class="mt-1 text-sm text-gray-600">Modular erweiterbar</p>
            </div>
        </div>
    </section>

    <section class="mt-16">
        <h2 class="text-xl font-bold">So funktioniert's</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-2xl font-bold text-gray-400">1</p>
                <h3 class="mt-2 font-semibold">Komponenten wählen</h3>
                <p class="mt-2 text-sm text-gray-600">Wähle CPU, Mainboard, RAM, GPU, Netzteil, SSD und Gehäuse aus dem Katalog.</p>
            </div>
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-2xl font-bold text-gray-400">2</p>
                <h3 class="mt-2 font-semibold">Automatische Prüfung</h3>
                <p class="mt-2 text-sm text-gray-600">Sockel, RAM-Typ, Formfaktor, Gehäuselänge und Netzteil-Wattzahl werden live validiert.</p>
            </div>
            <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                <p class="text-2xl font-bold text-gray-400">3</p>
                <h3 class="mt-2 font-semibold">Speichern & teilen</h3>
                <p class="mt-2 text-sm text-gray-600">Registriere dich, speichere deinen Build und teile ihn per öffentlichem Link.</p>
            </div>
        </div>
    </section>
@endsection
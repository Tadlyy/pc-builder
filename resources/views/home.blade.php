@extends('layouts.app')

@section('title', 'PC Builder Konfigurator')

@section('content')
    <section class="grid gap-8 lg:grid-cols-2 lg:items-center">
        <div>
            <p class="inline-flex items-center gap-2 rounded-full border border-cyan-800 bg-cyan-950/50 px-3 py-1 text-xs font-medium text-cyan-300">
                Laravel · Eloquent ORM · Blade · Tailwind CSS
            </p>
            <h1 class="mt-6 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Baue deinen
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">perfekten PC</span>
            </h1>
            <p class="mt-4 text-lg text-slate-400">
                Geführter Schritt-für-Schritt Konfigurator mit automatischer Kompatibilitätsprüfung.
                Sockel, Formfaktor, RAM-Typ und Wattzahl – alles wird in Echtzeit validiert.
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('configurator.index') }}"
                    class="rounded-xl bg-cyan-500 px-6 py-3 font-semibold text-slate-900 shadow-lg shadow-cyan-500/25 hover:bg-cyan-400 transition">
                    Konfiguration starten
                </a>
                <a href="{{ route('catalog.index') }}"
                    class="rounded-xl border border-slate-700 px-6 py-3 font-semibold text-slate-200 hover:bg-slate-800 transition">
                    Hardware-Katalog ansehen
                </a>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-3xl font-bold text-cyan-400">7</p>
                <p class="mt-1 text-sm text-slate-400">Komponenten-Kategorien</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-3xl font-bold text-cyan-400">100%</p>
                <p class="mt-1 text-sm text-slate-400">Kompatibilitäts-Garantie</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-3xl font-bold text-cyan-400">AM5 · LGA1700</p>
                <p class="mt-1 text-sm text-slate-400">Sockel-Validierung im Backend</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-3xl font-bold text-cyan-400">∞</p>
                <p class="mt-1 text-sm text-slate-400">Modular erweiterbar</p>
            </div>
        </div>
    </section>

    <section class="mt-16">
        <h2 class="text-xl font-bold">So funktioniert's</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-2xl font-bold text-slate-600">1</p>
                <h3 class="mt-2 font-semibold">Komponenten wählen</h3>
                <p class="mt-2 text-sm text-slate-400">Wähle CPU, Mainboard, RAM, GPU, Netzteil, SSD und Gehäuse aus dem Katalog.</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-2xl font-bold text-slate-600">2</p>
                <h3 class="mt-2 font-semibold">Automatische Prüfung</h3>
                <p class="mt-2 text-sm text-slate-400">Sockel, RAM-Typ, Formfaktor, Gehäuselänge und Netzteil-Wattzahl werden live validiert.</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-2xl font-bold text-slate-600">3</p>
                <h3 class="mt-2 font-semibold">Speichern & teilen</h3>
                <p class="mt-2 text-sm text-slate-400">Registriere dich, speichere deinen Build und teile ihn per öffentlichem Link.</p>
            </div>
        </div>
    </section>
@endsection
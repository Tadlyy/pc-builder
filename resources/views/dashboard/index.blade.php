@extends('layouts.app')

@section('title', 'Meine Builds')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Meine Builds</h1>
            <p class="mt-1 text-sm text-slate-400">Willkommen zurück, {{ auth()->user()->name }}.</p>
        </div>
        <a href="{{ route('configurator.index') }}"
            class="rounded-lg bg-cyan-500 px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-cyan-400 transition">
            Neuen PC konfigurieren
        </a>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($builds as $build)
            <div class="flex flex-col rounded-2xl border border-slate-800 bg-slate-900 p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h3 class="font-semibold">{{ $build->title }}</h3>
                        <p class="mt-1 text-xs text-slate-500">{{ $build->created_at->format('d.m.Y') }}</p>
                    </div>
                    <span class="shrink-0 rounded-lg bg-slate-800 px-2 py-1 text-sm font-bold text-emerald-400">
                        {{ number_format($build->total_price, 2, ',', '') }} CHF
                    </span>
                </div>

                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="rounded-full bg-slate-800 px-2 py-0.5 text-slate-400">{{ $build->products_count }} Komponenten</span>
                    @if ($build->is_public)
                        <span class="rounded-full bg-emerald-500/15 px-2 py-0.5 text-emerald-300">Öffentlich</span>
                    @else
                        <span class="rounded-full bg-slate-800 px-2 py-0.5 text-slate-500">Privat</span>
                    @endif
                </div>

                <div class="mt-4 flex-1 flex items-end gap-2">
                    <a href="{{ route('builds.show', $build) }}"
                        class="flex-1 rounded-lg bg-slate-800 px-4 py-2 text-center text-sm font-medium text-slate-200 hover:bg-cyan-500 hover:text-slate-900 transition">
                        Ansehen
                    </a>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-800 p-8 text-center text-sm text-slate-500 col-span-full">
                Du hast noch keine Builds gespeichert.
                <a href="{{ route('configurator.index') }}" class="text-cyan-400 hover:text-cyan-300">Konfiguriere jetzt deinen ersten PC.</a>
            </div>
        @endforelse
    </div>
@endsection
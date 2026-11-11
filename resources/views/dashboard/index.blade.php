@extends('layouts.app')

@section('title', 'Meine Builds')

@section('content')
    <div class="animate-fade-in-up space-y-8">
        <!-- Dashboard Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between border-b border-black/[0.06] pb-6">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-[#0071e3]">Persönlicher Bereich</span>
                <h1 class="mt-1 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f]">Meine Builds</h1>
                <p class="mt-1.5 text-sm text-[#86868b]">Willkommen zurück, <strong class="text-[#1d1d1f] font-semibold">{{ auth()->user()->name }}</strong>. Verwalte hier deine gespeicherten PC-Systeme.</p>
            </div>
            <div>
                <a href="{{ route('configurator.index') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-[#0071e3] px-5 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-[#0077ed] transition active:scale-95">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Neuen PC konfigurieren</span>
                </a>
            </div>
        </div>

        <!-- Builds Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($builds as $build)
                <div class="group flex flex-col justify-between rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5">
                    <div>
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-semibold text-[15px] text-[#1d1d1f] group-hover:text-[#0071e3] transition-colors leading-snug">
                                    {{ $build->title }}
                                </h3>
                                <p class="mt-1 text-xs text-[#86868b]">{{ $build->created_at->format('d.m.Y') }}</p>
                            </div>
                            <span class="shrink-0 rounded-full bg-black/[0.04] px-3 py-1 text-xs font-semibold text-[#1d1d1f]">
                                {{ number_format($build->total_price, 2, ',', '') }} CHF
                            </span>
                        </div>

                        <div class="mt-4 flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#f5f5f7] px-2.5 py-0.5 text-[11px] font-medium text-[#6e6e73]">
                                <span>{{ $build->products_count }} Komponenten</span>
                            </span>
                            @if ($build->is_public)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 border border-emerald-200/80 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-800">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Öffentlich</span>
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-black/[0.04] px-2.5 py-0.5 text-[11px] font-medium text-[#86868b]">
                                    Privat
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 flex-1 flex items-end">
                        <a href="{{ route('builds.show', $build) }}"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-black/[0.05] hover:bg-[#1d1d1f] hover:text-white px-4 py-2.5 text-center text-xs font-semibold text-[#1d1d1f] transition-all duration-200 active:scale-95">
                            <span>Öffnen &amp; Verwalten</span>
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-black/[0.1] bg-white/60 p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-black/[0.04] text-[#86868b]">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-base font-semibold text-[#1d1d1f]">Noch keine Builds vorhanden</h3>
                    <p class="mt-1 text-xs text-[#86868b]">Erstelle deinen ersten kompatiblen PC im interaktiven Konfigurator.</p>
                    <div class="mt-5">
                        <a href="{{ route('configurator.index') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-[#0071e3] px-5 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-[#0077ed] transition active:scale-95">
                            <span>Jetzt Konfiguration starten</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'PC Builder – Baue deinen Traum-PC')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-6 pb-12 sm:pt-10 sm:pb-16 lg:pb-20">
        <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
            <!-- Left Column: Copy & CTAs -->
            <div class="lg:col-span-7 space-y-6 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 rounded-full border border-black/[0.06] bg-white/80 px-3.5 py-1 text-xs font-medium text-[#1d1d1f] shadow-sm backdrop-blur-sm">
                    <span class="flex h-2 w-2 rounded-full bg-[#0071e3] animate-pulse"></span>
                    <span>Live-Kompatibilitätsprüfung v2.0</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-[64px] font-bold tracking-tight text-[#1d1d1f] leading-[1.08]">
                    Baue deinen <br class="hidden sm:inline">
                    <span class="bg-gradient-to-r from-[#1d1d1f] via-[#0071e3] to-[#1d1d1f] bg-clip-text text-transparent">perfekten PC.</span>
                </h1>

                <p class="text-lg sm:text-xl font-normal text-[#86868b] leading-relaxed max-w-xl">
                    Präzise abgestimmt. Automatisch validiert. Sockel, RAM-Generation, GPU-Länge und Netzteil-Wattage werden bei jedem Schritt in Echtzeit geprüft.
                </p>

                <div class="pt-2 flex flex-wrap items-center gap-3.5">
                    <a href="{{ route('configurator.index') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-[#0071e3] px-6 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0077ed] transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 active:scale-95">
                        <span>Konfiguration starten</span>
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('catalog.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-black/[0.1] bg-white px-6 py-3.5 text-sm font-semibold text-[#1d1d1f] shadow-sm hover:bg-[#fbfbfd] hover:border-black/[0.2] transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                        Hardware-Katalog
                    </a>
                </div>

                <div class="pt-4 flex items-center gap-6 text-xs text-[#86868b]">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Keine Fehlkäufe</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Schweizer Preise (CHF)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Sofort teilbar</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Apple Bento Grid Stats -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4 animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b]">Kategorien</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-black/[0.04] text-[#1d1d1f]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f]">7</p>
                        <p class="mt-0.5 text-xs text-[#86868b]">Komponenten-Module</p>
                    </div>
                </div>

                <div class="rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b]">Validierung</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f]">100%</p>
                        <p class="mt-0.5 text-xs text-[#86868b]">Kompatibilitäts-Garantie</p>
                    </div>
                </div>

                <div class="rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b]">Plattformen</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50 text-[#0071e3]">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-bold tracking-tight text-[#1d1d1f]">AM5 · LGA</p>
                        <p class="mt-0.5 text-xs text-[#86868b]">Echtzeit-Sockelprüfung</p>
                    </div>
                </div>

                <div class="rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b]">Flexibel</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f]">∞</p>
                        <p class="mt-0.5 text-xs text-[#86868b]">Modular &amp; Erweiterbar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works (Apple 3-Step Section) -->
    <section class="mt-8 pt-10 border-t border-black/[0.06]">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-xs font-semibold uppercase tracking-wider text-[#0071e3]">Einfach &amp; Durchdacht</h2>
            <p class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-[#1d1d1f]">In drei Schritten zum fertigen System.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="group rounded-3xl border border-black/[0.06] bg-white p-7 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] text-sm font-bold text-[#1d1d1f] group-hover:bg-[#1d1d1f] group-hover:text-white transition-colors duration-300">
                        01
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f]">Komponenten wählen</h3>
                    <p class="mt-2 text-sm text-[#86868b] leading-relaxed">
                        Wähle CPU, Mainboard, RAM, Grafikkarte, Netzteil, SSD und Gehäuse aus unserem ständig aktualisierten Hardware-Katalog.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] text-xs font-medium text-[#0071e3] flex items-center gap-1">
                    <span>Auswahl starten</span>
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>

            <div class="group rounded-3xl border border-black/[0.06] bg-white p-7 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] text-sm font-bold text-[#1d1d1f] group-hover:bg-[#1d1d1f] group-hover:text-white transition-colors duration-300">
                        02
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f]">Automatische Prüfung</h3>
                    <p class="mt-2 text-sm text-[#86868b] leading-relaxed">
                        Sockel-Passung, RAM-Typ, Gehäuse-Abmessungen und Gesamt-Wattbedarf werden im Hintergrund in Echtzeit validiert.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] text-xs font-medium text-[#34c759] flex items-center gap-1">
                    <span>100% Validiert</span>
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>

            <div class="group rounded-3xl border border-black/[0.06] bg-white p-7 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] text-sm font-bold text-[#1d1d1f] group-hover:bg-[#1d1d1f] group-hover:text-white transition-colors duration-300">
                        03
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f]">Speichern &amp; Teilen</h3>
                    <p class="mt-2 text-sm text-[#86868b] leading-relaxed">
                        Speichere deine Konfiguration in deinem Benutzerkonto und erstelle mit einem Klick einen öffentlichen Teilen-Link für Freunde.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] text-xs font-medium text-[#0071e3] flex items-center gap-1">
                    <span>Community Builds</span>
                    <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </div>
    </section>
@endsection

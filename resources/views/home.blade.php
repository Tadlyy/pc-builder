@extends('layouts.app')

@section('title', 'PC Builder – Baue deinen Traum-PC')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-6 pb-12 sm:pt-12 sm:pb-16 lg:pb-20">
        <!-- Subtle Apple Radial Background Ambient Glow (Light & Dark) -->
        <div class="pointer-events-none absolute -top-16 left-1/2 -translate-x-1/2 w-full max-w-4xl h-72 bg-gradient-to-b from-[#0071e3]/10 dark:from-[#2997ff]/15 via-transparent to-transparent blur-3xl rounded-full"></div>

        <div class="relative grid gap-12 lg:grid-cols-12 lg:items-center">
            <!-- Left Column: Copy & CTAs -->
            <div class="lg:col-span-7 space-y-6 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 rounded-full border border-black/[0.06] dark:border-white/[0.1] bg-white/80 dark:bg-[#161618]/80 px-3.5 py-1 text-xs font-medium text-[#1d1d1f] dark:text-[#f5f5f7] shadow-sm backdrop-blur-md">
                    <span class="flex h-2 w-2 rounded-full bg-[#0071e3] dark:bg-[#2997ff] animate-pulse"></span>
                    <span>Live-Kompatibilitätsprüfung v2.0</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-[66px] font-extrabold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7] leading-[1.06]">
                    Baue deinen <br class="hidden sm:inline">
                    <span class="bg-gradient-to-r from-[#1d1d1f] via-[#0071e3] to-[#1d1d1f] dark:from-white dark:via-[#2997ff] dark:to-[#a1a1a6] bg-clip-text text-transparent">perfekten PC.</span>
                </h1>

                <p class="text-lg sm:text-xl font-normal text-[#86868b] dark:text-[#a1a1a6] leading-relaxed max-w-xl">
                    Präzise abgestimmt. Automatisch validiert. Sockel, RAM-Generation, GPU-Länge und Netzteil-Wattage werden bei jedem Schritt in Echtzeit geprüft.
                </p>

                <div class="pt-2 flex flex-wrap items-center gap-3.5">
                    <a href="{{ route('configurator.index') }}"
                        class="group inline-flex items-center gap-2 rounded-full bg-[#0071e3] dark:bg-[#0071e3] px-7 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0077ed] dark:hover:bg-[#2997ff] transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/25 dark:hover:shadow-[0_0_28px_rgba(41,151,255,0.4)] hover:-translate-y-0.5 active:scale-95">
                        <span>Konfiguration starten</span>
                        <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="{{ route('catalog.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-black/[0.1] dark:border-white/[0.15] bg-white/80 dark:bg-white/[0.06] backdrop-blur-md px-7 py-3.5 text-sm font-semibold text-[#1d1d1f] dark:text-[#f5f5f7] shadow-sm hover:bg-[#fbfbfd] dark:hover:bg-white/[0.12] hover:border-black/[0.2] dark:hover:border-white/[0.25] transition-all duration-300 hover:-translate-y-0.5 active:scale-95">
                        Hardware-Katalog
                    </a>
                </div>

                <div class="pt-4 flex flex-wrap items-center gap-6 text-xs text-[#86868b] dark:text-[#737378]">
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Keine Fehlkäufe</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Schweizer Preise (CHF)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-[#34c759]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Sofort teilbar</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Apple Bento Grid Stats (Light & Dark) -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4 animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b] dark:text-[#a1a1a6]">Kategorien</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-black/[0.04] dark:bg-white/[0.08] text-[#1d1d1f] dark:text-white transition-transform group-hover:scale-110">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">7</p>
                        <p class="mt-0.5 text-xs text-[#86868b] dark:text-[#737378]">Komponenten-Module</p>
                    </div>
                </div>

                <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b] dark:text-[#a1a1a6]">Validierung</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 transition-transform group-hover:scale-110">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">100%</p>
                        <p class="mt-0.5 text-xs text-[#86868b] dark:text-[#737378]">Kompatibilitäts-Garantie</p>
                    </div>
                </div>

                <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b] dark:text-[#a1a1a6]">Plattformen</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50 dark:bg-blue-500/15 text-[#0071e3] dark:text-[#2997ff] transition-transform group-hover:scale-110">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-xl sm:text-2xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">AM5 · LGA</p>
                        <p class="mt-0.5 text-xs text-[#86868b] dark:text-[#737378]">Echtzeit-Sockelprüfung</p>
                    </div>
                </div>

                <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-0.5 flex flex-col justify-between h-40">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold tracking-wider uppercase text-[#86868b] dark:text-[#a1a1a6]">Flexibel</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-purple-50 dark:bg-purple-500/15 text-purple-600 dark:text-purple-400 transition-transform group-hover:scale-110">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">∞</p>
                        <p class="mt-0.5 text-xs text-[#86868b] dark:text-[#737378]">Modular &amp; Erweiterbar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works (Apple 3-Step Section) -->
    <section class="mt-8 pt-12 border-t border-black/[0.06] dark:border-white/[0.08]">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-xs font-semibold uppercase tracking-wider text-[#0071e3] dark:text-[#2997ff]">Einfach &amp; Durchdacht</h2>
            <p class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">In drei Schritten zum fertigen System.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-7 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] dark:bg-white/[0.08] text-sm font-bold text-[#1d1d1f] dark:text-[#f5f5f7] group-hover:bg-[#1d1d1f] group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-[#1d1d1f] transition-colors duration-300">
                        01
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">Komponenten wählen</h3>
                    <p class="mt-2 text-sm text-[#86868b] dark:text-[#a1a1a6] leading-relaxed">
                        Wähle CPU, Mainboard, RAM, Grafikkarte, Netzteil, SSD und Gehäuse aus unserem ständig aktualisierten Hardware-Katalog.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] dark:border-white/[0.06] text-xs font-semibold text-[#0071e3] dark:text-[#2997ff] flex items-center gap-1.5">
                    <span>Auswahl starten</span>
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>

            <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-7 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] dark:bg-white/[0.08] text-sm font-bold text-[#1d1d1f] dark:text-[#f5f5f7] group-hover:bg-[#1d1d1f] group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-[#1d1d1f] transition-colors duration-300">
                        02
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">Automatische Prüfung</h3>
                    <p class="mt-2 text-sm text-[#86868b] dark:text-[#a1a1a6] leading-relaxed">
                        Sockel-Passung, RAM-Typ, Gehäuse-Abmessungen und Gesamt-Wattbedarf werden im Hintergrund in Echtzeit validiert.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] dark:border-white/[0.06] text-xs font-semibold text-[#34c759] flex items-center gap-1.5">
                    <span>100% Validiert</span>
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>

            <div class="group rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-7 shadow-apple dark:shadow-apple-dark hover:shadow-apple-hover dark:hover:border-white/[0.18] transition-all duration-300 hover:-translate-y-1 flex flex-col justify-between">
                <div>
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black/[0.04] dark:bg-white/[0.08] text-sm font-bold text-[#1d1d1f] dark:text-[#f5f5f7] group-hover:bg-[#1d1d1f] group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-[#1d1d1f] transition-colors duration-300">
                        03
                    </span>
                    <h3 class="mt-5 text-base font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">Speichern &amp; Teilen</h3>
                    <p class="mt-2 text-sm text-[#86868b] dark:text-[#a1a1a6] leading-relaxed">
                        Speichere deine Konfiguration in deinem Benutzerkonto und erstelle mit einem Klick einen öffentlichen Teilen-Link für Freunde.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-black/[0.04] dark:border-white/[0.06] text-xs font-semibold text-[#0071e3] dark:text-[#2997ff] flex items-center gap-1.5">
                    <span>Community Builds</span>
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </div>
    </section>
@endsection

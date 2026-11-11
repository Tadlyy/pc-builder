@extends('layouts.app')

@section('title', 'Öffentliche Builds entdecken')

@section('content')
    <div class="animate-fade-in-up space-y-8">
        <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-[#0071e3] dark:text-[#2997ff]">Community &amp; Inspiration</span>
            <h1 class="mt-1 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">Öffentliche Builds entdecken</h1>
            <p class="mt-1.5 text-sm sm:text-base text-[#86868b] dark:text-[#a1a1a6]">
                Von der Community zusammengestellte und geprüfte PC-Konfigurationen.
            </p>
        </div>

        @if ($builds->isEmpty())
            <div class="rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-12 text-center shadow-apple dark:shadow-apple-dark">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-black/[0.04] dark:bg-white/[0.08] text-[#86868b] dark:text-[#a1a1a6]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="mt-4 text-base font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">Noch keine öffentlichen Builds</h3>
                <p class="mt-1 text-xs text-[#86868b] dark:text-[#737378]">Sei der Erste, der seine Wunschkonfiguration mit der Community teilt.</p>
                <div class="mt-6">
                    <a href="{{ route('configurator.index') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-[#0071e3] px-6 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-[#0077ed] dark:hover:bg-[#2997ff] transition active:scale-95">
                        <span>Jetzt PC konfigurieren</span>
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($builds as $build)
                    <x-build-card :build="$build" :href="route('builds.shared', $build->share_token)" />
                @endforeach
            </div>
        @endif
    </div>
@endsection

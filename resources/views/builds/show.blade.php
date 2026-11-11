@extends('layouts.app')

@section('title', $build->title)

@section('content')
    @php
        $isOwner = auth()->check() && auth()->id() === $build->user_id;
        $issues = $checked['issues'];
        $wattageUsed = (int) $checked['wattage_used'];
        $wattageCapacity = (int) $checked['wattage_capacity'];
        $total = (float) $build->products->sum(fn ($p) => $p->price * ($p->pivot->quantity ?? 1));
    @endphp

    <div class="animate-fade-in-up space-y-8">
        <!-- Top Bar: Breadcrumbs & Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between border-b border-black/[0.06] dark:border-white/[0.08] pb-6">
            <div>
                <nav class="flex items-center gap-2 text-xs text-[#86868b] dark:text-[#a1a1a6]">
                    @if ($shared)
                        <a href="{{ route('builds.public') }}" class="hover:text-[#1d1d1f] dark:hover:text-[#f5f5f7] transition">Öffentliche Builds</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-[#1d1d1f] dark:hover:text-[#f5f5f7] transition">Meine Builds</a>
                    @endif
                    <span class="text-black/[0.2] dark:text-white/[0.2]">/</span>
                    <span class="font-medium text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $build->title }}</span>
                </nav>
                <h1 class="mt-2 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $build->title }}</h1>
                <p class="mt-1.5 text-xs sm:text-sm text-[#86868b] dark:text-[#a1a1a6]">
                    Erstellt von <span class="font-medium text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $build->user->name }}</span> am {{ $build->created_at->format('d.m.Y') }}
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5">
                @if ($isOwner)
                    @if (! $build->is_public)
                        <form method="POST" action="{{ route('builds.share', $build) }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-full bg-[#0071e3] px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-[#0077ed] dark:hover:bg-[#2997ff] transition active:scale-95">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                <span>Öffentlich teilen</span>
                            </button>
                        </form>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 dark:bg-emerald-500/15 border border-emerald-200/80 dark:border-emerald-500/30 px-3.5 py-1.5 text-xs font-semibold text-emerald-800 dark:text-emerald-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span>Öffentlich geteilt</span>
                        </span>
                    @endif

                    <form method="POST" action="{{ route('builds.destroy', $build) }}"
                        onsubmit="return confirm('Build wirklich unwiderruflich löschen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-full border border-red-200 dark:border-red-500/30 bg-red-50/50 dark:bg-red-950/30 px-4 py-2 text-xs font-semibold text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/40 hover:border-red-300 transition active:scale-95">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span>Löschen</span>
                        </button>
                    </form>
                @elseif ($shared)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-black/[0.05] dark:bg-white/[0.08] px-3.5 py-1.5 text-xs font-medium text-[#6e6e73] dark:text-[#a1a1a6]">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Öffentlicher Build</span>
                    </span>
                @endif
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Left: Components Table -->
            <div class="lg:col-span-2 rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 sm:p-7 shadow-apple dark:shadow-apple-dark">
                <div class="flex items-center justify-between">
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-[#86868b] dark:text-[#a1a1a6]">Verbaute Komponenten</h2>
                    <span class="rounded-full bg-black/[0.05] dark:bg-white/[0.08] px-3 py-1 text-xs font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">
                        {{ $build->products->count() }} Komponenten
                    </span>
                </div>

                <ul class="mt-6 divide-y divide-black/[0.05] dark:divide-white/[0.06]">
                    @foreach ($build->products as $product)
                        <li class="flex flex-wrap items-center justify-between gap-3 py-3.5">
                            <div>
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-[#0071e3] dark:text-[#2997ff]">
                                    {{ $product->category->name }}
                                </span>
                                <p class="text-sm font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">{{ $product->name }}</p>
                            </div>
                            <div class="flex items-center gap-3 text-sm">
                                @if (($product->pivot->quantity ?? 1) > 1)
                                    <span class="rounded-md bg-black/[0.05] dark:bg-white/[0.08] px-2 py-0.5 text-xs text-[#86868b] dark:text-[#a1a1a6]">
                                        × {{ $product->pivot->quantity }}
                                    </span>
                                @endif
                                <span class="font-semibold text-[#1d1d1f] dark:text-[#f5f5f7]">
                                    {{ number_format($product->price * ($product->pivot->quantity ?? 1), 2, ',', '') }} CHF
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-6 flex items-baseline justify-between border-t border-black/[0.06] dark:border-white/[0.08] pt-5">
                    <span class="text-base font-bold text-[#1d1d1f] dark:text-[#f5f5f7]">Gesamtsumme</span>
                    <span class="text-2xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">
                        {{ number_format($total, 2, ',', '') }} <span class="text-xs font-normal text-[#86868b] dark:text-[#737378]">CHF</span>
                    </span>
                </div>
            </div>

            <!-- Right Sidebar: Specs & Status -->
            <aside class="space-y-6">
                <!-- Power Status -->
                <div class="rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-6 shadow-apple dark:shadow-apple-dark">
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-[#86868b] dark:text-[#a1a1a6]">Netzteil &amp; Energie</h2>
                    <p class="mt-3 text-sm font-medium text-[#1d1d1f] dark:text-[#f5f5f7]">
                        {{ $wattageUsed }} W Leistungsbedarf
                        @if ($wattageCapacity > 0)
                            <span class="text-[#86868b] dark:text-[#737378] font-normal">/ {{ $wattageCapacity }} W Kapazität</span>
                        @endif
                    </p>

                    @if ($wattageCapacity > 0)
                        @php $percent = min(100, round($wattageUsed / $wattageCapacity * 100)); @endphp
                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-black/[0.06] dark:bg-white/[0.1]">
                            <div class="h-full rounded-full transition-all duration-500 {{ $percent <= 100 ? 'bg-[#34c759] dark:bg-[#30d158]' : 'bg-[#ff3b30] dark:bg-[#ff453a]' }}"
                                style="width: {{ $percent }}%"></div>
                        </div>
                        <p class="mt-2 text-xs text-[#86868b] dark:text-[#737378]">{{ $percent }}% Netzteilauslastung</p>
                    @endif
                </div>

                <!-- Compatibility Badge Box -->
                <div class="rounded-3xl border p-6 shadow-apple dark:shadow-apple-dark
                    {{ $issues !== [] ? 'border-red-200/80 dark:border-red-500/30 bg-red-50/70 dark:bg-red-950/30 text-red-950 dark:text-red-200' : 'border-emerald-200/80 dark:border-emerald-500/30 bg-emerald-50/70 dark:bg-emerald-950/30 text-emerald-950 dark:text-emerald-200' }}">
                    <div class="flex items-center gap-3">
                        @if ($issues !== [])
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-red-600 dark:bg-red-500 text-white">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        @else
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-600 dark:bg-emerald-500 text-white">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        @endif
                        <div>
                            <p class="font-bold text-sm">
                                {{ $issues !== [] ? 'Kompatibilitäts-Probleme' : '100% kompatibel' }}
                            </p>
                            <p class="text-xs opacity-80">
                                {{ $issues !== [] ? 'Einige Komponenten weisen Konflikte auf' : 'Alle Komponenten harmonieren optimal' }}
                            </p>
                        </div>
                    </div>

                    @if ($issues !== [])
                        <ul class="mt-4 space-y-1.5 border-t border-red-200/80 dark:border-red-500/30 pt-3 text-xs text-red-900 dark:text-red-300">
                            @foreach ($issues as $issue)
                                <li class="flex items-start gap-2">
                                    <span class="text-red-500 dark:text-red-400 font-bold mt-0.5">•</span>
                                    <span>{{ $issue }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </aside>
        </div>
    </div>
@endsection

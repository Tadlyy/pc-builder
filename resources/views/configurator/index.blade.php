@extends('layouts.app')

@section('title', 'PC Konfigurator – Schritt für Schritt')

@section('content')
    @php
        $total = (float) $totalPrice;
        $issues = $checked['issues'];
        $wattageUsed = (int) $checked['wattage_used'];
        $wattageCapacity = (int) $checked['wattage_capacity'];
        $pcPercent = $wattageCapacity > 0 ? min(100, (int) round($wattageUsed / $wattageCapacity * 100)) : 0;
        $hasPsu = $selected->contains(fn ($p) => $p->category->slug === 'netzteil');
    @endphp

    <div class="grid gap-8 lg:grid-cols-3">
        <!-- Main Configurator Column -->
        <div class="lg:col-span-2 space-y-10 animate-fade-in-up">
            <!-- Header -->
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-[#0071e3]">Interaktiver Builder</span>
                <h1 class="mt-1 text-3xl sm:text-4xl font-bold tracking-tight text-[#1d1d1f]">PC Konfigurator</h1>
                <p class="mt-2 text-sm sm:text-base text-[#86868b] leading-relaxed">
                    Schritt für Schritt zu deinem perfekt abgestimmten Wunsch-PC. Jede Komponente wird in Echtzeit auf Sockel-, RAM- und Watt-Kompatibilität geprüft.
                </p>
            </div>

            <!-- Current Selection Box (Apple Receipt Card) -->
            <div class="rounded-3xl border border-black/[0.06] bg-white p-6 sm:p-7 shadow-apple">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="flex h-7 w-7 items-center justify-center rounded-xl bg-black/[0.05] text-[#1d1d1f]">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-[#86868b]">Aktuelle Zusammenstellung</h2>
                    </div>
                    <span class="rounded-full bg-black/[0.05] px-3 py-1 text-xs font-semibold text-[#1d1d1f]">
                        {{ $selected->count() }} / 7 gewählt
                    </span>
                </div>

                @if ($selected->isEmpty())
                    <div class="mt-6 rounded-2xl bg-[#fbfbfd] border border-black/[0.04] p-8 text-center">
                        <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-black/[0.04] text-[#86868b]">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="mt-3 text-sm font-medium text-[#1d1d1f]">Noch keine Komponenten gewählt</p>
                        <p class="mt-1 text-xs text-[#86868b]">Wähle unten zuerst einen Prozessor (CPU), um passende Mainboards und RAMs anzuzeigen.</p>
                    </div>
                @else
                    <ul class="mt-4 divide-y divide-black/[0.05]">
                        @foreach ($selected as $product)
                            <li class="flex items-center justify-between gap-4 py-3 sm:py-3.5">
                                <div class="min-w-0">
                                    <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-[#0071e3]">
                                        {{ $product->category->name }}
                                    </span>
                                    <p class="truncate text-sm font-semibold text-[#1d1d1f]">{{ $product->name }}</p>
                                </div>
                                <div class="flex shrink-0 items-center gap-3">
                                    <span class="text-sm font-semibold text-[#1d1d1f]">
                                        {{ number_format($product->price, 2, ',', '') }} CHF
                                    </span>
                                    <form method="POST" action="{{ route('configurator.remove', $product) }}">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-center rounded-full border border-black/[0.08] bg-white px-2.5 py-1 text-[11px] font-medium text-[#86868b] hover:border-red-300 hover:bg-red-50 hover:text-red-600 transition active:scale-95 shadow-sm">
                                            Entfernen
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-4 pt-3 border-t border-black/[0.05] flex items-center justify-between">
                        <form method="POST" action="{{ route('configurator.clear') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-medium text-[#86868b] hover:text-red-600 transition">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Konfigurator zurücksetzen</span>
                            </button>
                        </form>
                        <span class="text-xs font-medium text-[#86868b]">Zwischensumme: <strong class="text-[#1d1d1f] font-semibold">{{ number_format($total, 2, ',', '') }} CHF</strong></span>
                    </div>
                @endif
            </div>

            <!-- Categories Sections -->
            @foreach ($categories as $category)
                @php
                    $hiddenCount = $category->products->filter(
                        fn ($p) => ! ($compatibleById[$p->id] ?? true) && ! $selected->contains('id', $p->id)
                    )->count();
                    $picked = $selected->firstWhere('category_id', $category->id);
                @endphp
                <section class="space-y-4 pt-2">
                    <div class="flex flex-wrap items-center justify-between gap-3 pb-2 border-b border-black/[0.05]">
                        <div class="flex items-center gap-3">
                            <h2 class="text-xl font-bold tracking-tight text-[#1d1d1f]">{{ $category->name }}</h2>
                            @if ($hiddenCount > 0)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 px-2.5 py-0.5 text-[11px] font-medium text-amber-800">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    <span>{{ $hiddenCount }} inkompatibel ausgeblendet</span>
                                </span>
                            @endif
                        </div>

                        @if ($picked)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 px-3 py-1 text-xs font-semibold text-[#0071e3]">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="truncate max-w-[220px]">Ausgewählt: {{ $picked->name }}</span>
                            </span>
                        @endif
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($category->products as $product)
                            @php
                                $hidden = ! ($compatibleById[$product->id] ?? true) && ! $selected->contains('id', $product->id);
                                $isThisSelected = $selected->contains('id', $product->id);
                            @endphp
                            <div class="{{ $hidden ? 'hidden' : '' }}">
                                <x-product-card :product="$product" :is-selected="$isThisSelected">
                                    <form method="POST" action="{{ route('configurator.add', $product) }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-1.5 rounded-full px-4 py-2.5 text-xs font-semibold transition-all duration-200 active:scale-95
                                                {{ $isThisSelected
                                                    ? 'bg-[#0071e3] text-white hover:bg-[#0077ed] shadow-sm'
                                                    : 'bg-black/[0.05] text-[#1d1d1f] hover:bg-[#1d1d1f] hover:text-white' }}">
                                            @if ($isThisSelected)
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Gewählt (erneut wählen)</span>
                                            @else
                                                <span>Auswählen</span>
                                            @endif
                                        </button>
                                    </form>
                                </x-product-card>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Sticky Sidebar (Apple Summary Widget) -->
        <aside class="space-y-6 lg:sticky lg:top-20 lg:self-start">
            <!-- Price Summary Card -->
            <div class="rounded-3xl border border-black/[0.06] bg-white p-6 sm:p-7 shadow-apple">
                <div class="flex items-center justify-between">
                    <h2 class="text-xs font-semibold uppercase tracking-wider text-[#86868b]">Zusammenfassung</h2>
                    <span class="text-xs font-medium text-[#86868b]">{{ $selected->count() }} Artikel</span>
                </div>

                <dl class="mt-4 space-y-2.5 text-xs">
                    @forelse ($selected as $product)
                        <div class="flex items-center justify-between gap-3">
                            <dt class="truncate text-[#6e6e73]">{{ $product->category->name }}</dt>
                            <dd class="font-medium text-[#1d1d1f] shrink-0">{{ number_format($product->price, 2, ',', '') }} CHF</dd>
                        </div>
                    @empty
                        <p class="py-2 text-center text-xs text-[#86868b]">Keine Positionen gewählt</p>
                    @endforelse

                    <div class="flex items-baseline justify-between border-t border-black/[0.06] pt-4 text-base font-bold">
                        <dt class="text-[#1d1d1f]">Gesamtpreis</dt>
                        <dd class="text-xl font-bold tracking-tight text-[#1d1d1f]">{{ number_format($total, 2, ',', '') }} <span class="text-xs font-normal text-[#86868b]">CHF</span></dd>
                    </div>
                </dl>

                <!-- Power Supply Gauge (Apple Battery / Meter Style) -->
                <div class="mt-6 pt-5 border-t border-black/[0.06]">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-medium text-[#6e6e73]">Netzteil-Auslastung</span>
                        <span class="font-semibold {{ $hasPsu && $pcPercent <= 100 ? 'text-[#34c759]' : ($hasPsu ? 'text-[#ff3b30]' : 'text-[#86868b]') }}">
                            {{ $wattageUsed }} W / {{ $hasPsu ? $wattageCapacity.' W' : '—' }}
                        </span>
                    </div>

                    @if ($hasPsu)
                        <div class="mt-2.5 h-2 overflow-hidden rounded-full bg-black/[0.06]">
                            <div class="h-full rounded-full transition-all duration-500 {{ $pcPercent <= 100 ? 'bg-[#34c759]' : 'bg-[#ff3b30]' }}"
                                style="width: {{ $pcPercent }}%"></div>
                        </div>
                        <p class="mt-2 text-[11px] text-[#86868b]">
                            {{ $pcPercent }}% ausgelastet · {{ max(0, round((1 - $pcPercent / 100) * 100)) }}% Watt-Reserve vorhanden
                        </p>
                    @else
                        <div class="mt-2.5 rounded-xl bg-amber-50/70 border border-amber-200/70 p-2.5 text-[11px] text-amber-800">
                            Wähle ein Netzteil für die genaue Watt-Berechnung.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Compatibility Status Card -->
            <div class="rounded-3xl border p-6 transition-all duration-300 shadow-apple
                {{ $issues !== []
                    ? 'border-red-200/80 bg-red-50/70 text-red-950'
                    : ($selected->count() < 7
                        ? 'border-amber-200/70 bg-amber-50/60 text-amber-950'
                        : 'border-emerald-200/80 bg-emerald-50/70 text-emerald-950') }}">
                <div class="flex items-start gap-3.5">
                    @if ($issues !== [])
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-2xl bg-red-600 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                    @elseif ($selected->count() < 7)
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-2xl bg-amber-500 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="9"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 3"/>
                            </svg>
                        </div>
                    @else
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-white shadow-sm">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    @endif

                    <div>
                        <p class="font-bold text-sm tracking-tight">
                            {{ $issues !== [] ? 'Kompatibilitäts-Probleme' : ($selected->count() < 7 ? 'Konfiguration noch unvollständig' : '100% kompatibel') }}
                        </p>
                        <p class="mt-0.5 text-xs opacity-80">
                            {{ $issues !== [] ? $selected->count().' von 7 Kategorien gewählt' : ($selected->count() < 7 ? 'Noch '.(7 - $selected->count()).' Komponenten nötig' : 'Alle gewählten Komponenten passen zusammen') }}
                        </p>
                    </div>
                </div>

                @if ($issues !== [])
                    <ul class="mt-4 space-y-1.5 border-t border-red-200/80 pt-3 text-xs text-red-900">
                        @foreach ($issues as $issue)
                            <li class="flex items-start gap-2">
                                <span class="text-red-500 font-bold mt-0.5">•</span>
                                <span>{{ $issue }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Save Build Card -->
            @auth
                <form method="POST" action="{{ route('builds.store') }}" class="rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple">
                    @csrf
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b]">Build speichern</label>
                    <input id="title" type="text" name="title" required
                        placeholder="z.B. Mein Gaming-PC AM5"
                        value="{{ old('title') }}"
                        class="mt-2.5 w-full rounded-2xl border border-black/[0.08] bg-[#fbfbfd] px-4 py-2.5 text-sm text-[#1d1d1f] placeholder-[#86868b] shadow-inner focus:bg-white focus:border-[#0071e3] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 transition">
                    <button type="submit" {{ $selected->isEmpty() ? 'disabled' : '' }}
                        class="mt-3.5 w-full rounded-full bg-[#1d1d1f] px-4 py-3 text-xs font-semibold text-white shadow-sm hover:bg-black transition-all duration-200 hover:shadow active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-40">
                        In Profil speichern
                    </button>
                </form>
            @else
                <div class="rounded-3xl border border-black/[0.06] bg-white p-6 text-center text-xs text-[#86868b] shadow-apple">
                    <p class="font-medium text-[#1d1d1f]">Möchtest du deinen Build sichern?</p>
                    <p class="mt-1">
                        <a href="{{ route('login') }}" class="font-semibold text-[#0071e3] hover:underline">Melde dich an</a>, um Zusammenstellungen dauerhaft zu speichern und öffentlich zu teilen.
                    </p>
                </div>
            @endauth
        </aside>
    </div>
@endsection

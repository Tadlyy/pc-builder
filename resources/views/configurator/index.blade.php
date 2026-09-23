@extends('layouts.app')

@section('title', 'PC Konfigurator')

@section('content')
    @php
        $total = (float) $totalPrice;
        $issues = $checked['issues'];
        $wattageUsed = (int) $checked['wattage_used'];
        $wattageCapacity = (int) $checked['wattage_capacity'];
        $pcPercent = $wattageCapacity > 0 ? min(100, (int) round($wattageUsed / $wattageCapacity * 100)) : 0;
        $hasPsu = $selected->contains(fn ($p) => $p->category->slug === 'netzteil');
    @endphp

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-8">
            <div>
                <h1 class="text-2xl font-bold">PC Konfigurator</h1>
                <p class="mt-1 text-sm text-slate-400">
                    Schritt für Schritt zu deinem kompatiblen Wunsch-PC. Jede Auswahl wird sofort geprüft.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Aktuelle Auswahl</h2>

                @if ($selected->isEmpty())
                    <p class="mt-4 text-sm text-slate-500">Noch keine Komponenten gewählt. Starte unten bei der CPU.</p>
                @else
                    <ul class="mt-4 divide-y divide-slate-800">
                        @foreach ($selected as $product)
                            <li class="flex items-center justify-between gap-4 py-3">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-cyan-400">{{ $product->category->name }}</p>
                                    <p class="text-sm font-medium">{{ $product->name }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <p class="text-sm font-bold text-emerald-400">{{ number_format($product->price, 2, ',', '') }} CHF</p>
                                    <form method="POST" action="{{ route('configurator.remove', $product) }}">
                                        @csrf
                                        <button type="submit"
                                            class="rounded-lg border border-slate-700 px-2.5 py-1 text-xs text-slate-400 hover:border-rose-500 hover:text-rose-300 transition">
                                            Entfernen
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('configurator.clear') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="text-xs text-slate-500 hover:text-rose-300 transition">
                            Konfigurator zurücksetzen
                        </button>
                    </form>
                @endif
            </div>

            @foreach ($categories as $category)
                @php
                    $hiddenCount = $category->products->filter(
                        fn ($p) => ! ($compatibleById[$p->id] ?? true) && ! $selected->contains('id', $p->id)
                    )->count();
                @endphp
                <section>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="flex items-center gap-3">
                            <h2 class="text-lg font-bold">{{ $category->name }}</h2>
                            @if ($hiddenCount > 0)
                                <span class="rounded-full bg-amber-500/15 px-3 py-1 text-xs font-medium text-amber-300">
                                    {{ $hiddenCount }} inkompatibel ausgeblendet
                                </span>
                            @endif
                        </div>
                        @php $picked = $selected->firstWhere('category_id', $category->id); @endphp
                        @if ($picked)
                            <span class="rounded-full bg-cyan-500/15 px-3 py-1 text-xs font-medium text-cyan-300">
                                Ausgewählt: {{ $picked->name }}
                            </span>
                        @endif
                    </div>

                    <div class="mt-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($category->products as $product)
                            @php
                                $hidden = ! ($compatibleById[$product->id] ?? true) && ! $selected->contains('id', $product->id);
                            @endphp
                            <div class="{{ $hidden ? 'hidden' : '' }}">
                                <x-product-card :product="$product"
                                    :is-selected="$selected->contains('id', $product->id)">
                                    <form method="POST" action="{{ route('configurator.add', $product) }}" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full rounded-lg px-4 py-2 text-sm font-medium transition
                                                {{ $selected->contains('id', $product->id)
                                                    ? 'bg-cyan-500 text-slate-900 hover:bg-cyan-400'
                                                    : 'bg-slate-800 text-slate-200 hover:bg-cyan-500 hover:text-slate-900' }}">
                                            {{ $selected->contains('id', $product->id) ? 'Ausgewählt – erneut wählen' : 'Auswählen' }}
                                        </button>
                                    </form>
                                </x-product-card>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="font-bold">Zusammenfassung</h2>

                <dl class="mt-4 space-y-2 text-sm">
                    @foreach ($selected as $product)
                        <div class="flex justify-between gap-3">
                            <dt class="text-slate-400">{{ $product->category->name }}</dt>
                            <dd class="text-right text-slate-200">{{ number_format($product->price, 2, ',', '') }} CHF</dd>
                        </div>
                    @endforeach
                    <div class="flex justify-between border-t border-slate-800 pt-3 text-base font-bold">
                        <dt>Gesamtpreis</dt>
                        <dd class="text-emerald-400">{{ number_format($total, 2, ',', '') }} CHF</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-400">Netzteil-Last</span>
                        <span class="font-medium {{ $hasPsu && $pcPercent <= 100 ? 'text-emerald-400' : 'text-slate-400' }}">
                            {{ $wattageUsed }} W / {{ $hasPsu ? $wattageCapacity.' W' : '—' }}
                        </span>
                    </div>
                    @if ($hasPsu)
                        <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-slate-800">
                            <div class="h-full rounded-full transition-all {{ $pcPercent <= 100 ? 'bg-emerald-500' : 'bg-rose-500' }}"
                                style="width: {{ $pcPercent }}%"></div>
                        </div>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ $pcPercent }}% der Netzteilleistung ausgelastet ({{ round((1 - $pcPercent / 100) * 100) }}% Reserve)
                        </p>
                    @else
                        <p class="mt-1 text-xs text-amber-400">Wähle ein Netzteil, um die Wattzahl automatisch zu prüfen.</p>
                    @endif
                </div>
            </div>

            <div class="rounded-2xl border p-6
                {{ $issues !== [] ? 'border-rose-700/60 bg-rose-950/40' : ($selected->count() < 7 ? 'border-amber-700/60 bg-amber-950/40' : 'border-emerald-700/60 bg-emerald-950/40') }}">
                <div class="flex items-center gap-3">
                    @php
                        $icon = $issues !== [] ? '✕' : ($selected->count() < 7 ? '◔' : '✓');
                    @endphp
                    <span class="text-2xl font-bold
                        {{ $issues !== [] ? 'text-rose-400' : ($selected->count() < 7 ? 'text-amber-400' : 'text-emerald-400') }}">{{ $icon }}</span>
                    <div>
                        <p class="font-bold">
                            {{ $issues !== [] ? 'Kompatibilitäts-Probleme' : ($selected->count() < 7 ? 'Konfiguration unvollständig' : 'Kompatibel – 100%') }}
                        </p>
                        <p class="text-xs text-slate-400">
                            {{ $issues !== [] ? $selected->count().' von 7 Kategorien gewählt' : ($selected->count() < 7 ? 'Noch '.(7 - $selected->count()).' Komponenten zu wählen' : 'Alle Komponenten passen zusammen') }}
                        </p>
                    </div>
                </div>

                @if ($issues !== [])
                    <ul class="mt-4 space-y-2">
                        @foreach ($issues as $issue)
                            <li class="flex gap-2 text-sm text-rose-200">
                                <span class="text-rose-400">•</span>
                                {{ $issue }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @auth
                <form method="POST" action="{{ route('builds.store') }}" class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                    @csrf
                    <label for="title" class="text-sm font-medium text-slate-300">Build speichern</label>
                    <input id="title" type="text" name="title" required
                        placeholder="z.B. Gaming-PC AM5"
                        value="{{ old('title') }}"
                        class="mt-2 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                    <button type="submit" {{ $selected->isEmpty() ? 'disabled' : '' }}
                        class="mt-3 w-full rounded-lg bg-cyan-500 px-4 py-2.5 font-semibold text-slate-900 hover:bg-cyan-400 transition disabled:cursor-not-allowed disabled:opacity-40">
                        Build speichern
                    </button>
                </form>
            @else
                <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6 text-sm text-slate-400">
                    <a href="{{ route('login') }}" class="font-medium text-cyan-400 hover:text-cyan-300">Melde dich an</a>, um deinen Build dauerhaft zu speichern und zu teilen.
                </div>
            @endauth
        </aside>
    </div>
@endsection
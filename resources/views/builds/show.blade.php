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

    <div class="flex flex-wrap items-start justify-between gap-4">
        <div>
            <nav class="text-sm text-slate-400">
                @if ($shared)
                    <a href="{{ route('builds.public') }}" class="hover:text-cyan-300">Builds</a>
                @else
                    <a href="{{ route('dashboard') }}" class="hover:text-cyan-300">Meine Builds</a>
                @endif
                <span class="mx-2">/</span>
                <span class="text-slate-200">{{ $build->title }}</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold">{{ $build->title }}</h1>
            <p class="mt-1 text-sm text-slate-400">
                von {{ $build->user->name }} · erstellt am {{ $build->created_at->format('d.m.Y') }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if ($isOwner)
                @if (! $build->is_public)
                    <form method="POST" action="{{ route('builds.share', $build) }}">
                        @csrf
                        <button type="submit"
                            class="rounded-lg border border-cyan-500 px-4 py-2 text-sm font-medium text-cyan-300 hover:bg-cyan-500/10 transition">
                            Link teilen
                        </button>
                    </form>
                @else
                    <span class="rounded-lg bg-emerald-500/15 px-3 py-2 text-sm font-medium text-emerald-300">
                        Öffentlich geteilt
                    </span>
                @endif
                <form method="POST" action="{{ route('builds.destroy', $build) }}"
                    onsubmit="return confirm('Build wirklich löschen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-lg border border-rose-700 px-4 py-2 text-sm font-medium text-rose-300 hover:bg-rose-900/30 transition">
                        Löschen
                    </button>
                </form>
            @elseif ($shared)
                <span class="rounded-lg bg-slate-800 px-3 py-2 text-sm text-slate-400">Geteilter Build</span>
            @endif
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-slate-800 bg-slate-900 p-6">
            <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Komponenten</h2>
            <ul class="mt-4 divide-y divide-slate-800">
                @foreach ($build->products as $product)
                    <li class="flex flex-wrap items-center justify-between gap-2 py-3">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-cyan-400">{{ $product->category->name }}</p>
                            <p class="text-sm font-medium">{{ $product->name }}</p>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            @if (($product->pivot->quantity ?? 1) > 1)
                                <span class="text-slate-500">× {{ $product->pivot->quantity }}</span>
                            @endif
                            <span class="font-bold text-emerald-400">
                                {{ number_format($product->price * ($product->pivot->quantity ?? 1), 2, ',', '') }} CHF
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-between border-t border-slate-800 pt-4 text-lg font-bold">
                <span>Gesamtpreis</span>
                <span class="text-emerald-400">{{ number_format($total, 2, ',', '') }} CHF</span>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-slate-400">Netzteil-Last</h2>
                <p class="mt-3 text-sm text-slate-300">
                    {{ $wattageUsed }} W verbraucht
                    @if ($wattageCapacity > 0)
                        von {{ $wattageCapacity }} W
                    @endif
                </p>
                @if ($wattageCapacity > 0)
                    @php $percent = min(100, round($wattageUsed / $wattageCapacity * 100)); @endphp
                    <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-slate-800">
                        <div class="h-full rounded-full {{ $percent <= 100 ? 'bg-emerald-500' : 'bg-rose-500' }}" style="width: {{ $percent }}%"></div>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">{{ $percent }}% ausgelastet</p>
                @endif
            </div>

            <div class="rounded-2xl border p-6
                {{ $issues !== [] ? 'border-rose-700/60 bg-rose-950/40' : 'border-emerald-700/60 bg-emerald-950/40' }}">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-bold {{ $issues !== [] ? 'text-rose-400' : 'text-emerald-400' }}">
                        {{ $issues !== [] ? '✕' : '✓' }}
                    </span>
                    <p class="font-bold">
                        {{ $issues !== [] ? 'Inkompatibel' : '100% kompatibel' }}
                    </p>
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
        </aside>
    </div>
@endsection
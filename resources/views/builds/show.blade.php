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
            <nav class="text-sm text-gray-600">
                @if ($shared)
                    <a href="{{ route('builds.public') }}" class="hover:text-blue-700">Builds</a>
                @else
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-700">Meine Builds</a>
                @endif
                <span class="mx-2">/</span>
                <span class="text-gray-800">{{ $build->title }}</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold">{{ $build->title }}</h1>
            <p class="mt-1 text-sm text-gray-600">
                von {{ $build->user->name }} · erstellt am {{ $build->created_at->format('d.m.Y') }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            @if ($isOwner)
                @if (! $build->is_public)
                    <form method="POST" action="{{ route('builds.share', $build) }}">
                        @csrf
                        <button type="submit"
                            class="rounded-lg border border-blue-500 px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-500/10 transition">
                            Link teilen
                        </button>
                    </form>
                @else
                    <span class="rounded-lg bg-green-500/15 px-3 py-2 text-sm font-medium text-green-300">
                        Öffentlich geteilt
                    </span>
                @endif
                <form method="POST" action="{{ route('builds.destroy', $build) }}"
                    onsubmit="return confirm('Build wirklich löschen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-lg border border-red-300 px-4 py-2 text-sm font-medium text-red-700 hover:bg-red-100/30 transition">
                        Löschen
                    </button>
                </form>
            @elseif ($shared)
                <span class="rounded-lg bg-gray-200 px-3 py-2 text-sm text-gray-600">Geteilter Build</span>
            @endif
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white p-6">
            <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-600">Komponenten</h2>
            <ul class="mt-4 divide-y divide-gray-200">
                @foreach ($build->products as $product)
                    <li class="flex flex-wrap items-center justify-between gap-2 py-3">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-blue-600">{{ $product->category->name }}</p>
                            <p class="text-sm font-medium">{{ $product->name }}</p>
                        </div>
                        <div class="flex items-center gap-3 text-sm">
                            @if (($product->pivot->quantity ?? 1) > 1)
                                <span class="text-gray-500">× {{ $product->pivot->quantity }}</span>
                            @endif
                            <span class="font-bold text-green-600">
                                {{ number_format($product->price * ($product->pivot->quantity ?? 1), 2, ',', '') }} CHF
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 flex justify-between border-t border-gray-200 pt-4 text-lg font-bold">
                <span>Gesamtpreis</span>
                <span class="text-green-600">{{ number_format($total, 2, ',', '') }} CHF</span>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white p-6">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-600">Netzteil-Last</h2>
                <p class="mt-3 text-sm text-gray-700">
                    {{ $wattageUsed }} W verbraucht
                    @if ($wattageCapacity > 0)
                        von {{ $wattageCapacity }} W
                    @endif
                </p>
                @if ($wattageCapacity > 0)
                    @php $percent = min(100, round($wattageUsed / $wattageCapacity * 100)); @endphp
                    <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-gray-200">
                        <div class="h-full rounded-full {{ $percent <= 100 ? 'bg-green-500' : 'bg-red-500' }}" style="width: {{ $percent }}%"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">{{ $percent }}% ausgelastet</p>
                @endif
            </div>

            <div class="rounded-2xl border p-6
                {{ $issues !== [] ? 'border-red-300/60 bg-red-950/40' : 'border-green-300/60 bg-green-950/40' }}">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-bold {{ $issues !== [] ? 'text-red-600' : 'text-green-600' }}">
                        {{ $issues !== [] ? '✕' : '✓' }}
                    </span>
                    <p class="font-bold">
                        {{ $issues !== [] ? 'Inkompatibel' : '100% kompatibel' }}
                    </p>
                </div>
                @if ($issues !== [])
                    <ul class="mt-4 space-y-2">
                        @foreach ($issues as $issue)
                            <li class="flex gap-2 text-sm text-red-800">
                                <span class="text-red-600">•</span>
                                {{ $issue }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </aside>
    </div>
@endsection
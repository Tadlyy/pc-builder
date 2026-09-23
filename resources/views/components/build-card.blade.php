@props(['build'])

<div class="flex flex-col rounded-2xl border border-slate-800 bg-slate-900 p-5">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h3 class="font-semibold">{{ $build->title }}</h3>
            <p class="mt-1 text-xs text-slate-500">
                von {{ $build->user->name }} · {{ $build->created_at->format('d.m.Y') }}
            </p>
        </div>
        <span class="shrink-0 rounded-lg bg-slate-800 px-2 py-1 text-sm font-bold text-emerald-400">
            {{ number_format($build->total_price, 2, ',', '') }} CHF
        </span>
    </div>

    <p class="mt-3 text-xs text-slate-400">
        {{ $build->products_count }} Komponenten
    </p>

    <div class="mt-4 flex-1 flex items-end">
        <a href="{{ $href ?? route('builds.show', $build) }}"
            class="w-full rounded-lg bg-slate-800 px-4 py-2 text-center text-sm font-medium text-slate-200 transition hover:bg-cyan-500 hover:text-slate-900">
            Build ansehen
        </a>
    </div>
</div>
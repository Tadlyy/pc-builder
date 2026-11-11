@props(['build', 'href' => null])

<div class="group flex flex-col justify-between rounded-3xl border border-black/[0.06] bg-white p-6 shadow-apple hover:shadow-apple-hover transition-all duration-300 hover:-translate-y-0.5">
    <div>
        <div class="flex items-start justify-between gap-3">
            <div>
                <h3 class="font-semibold text-[15px] text-[#1d1d1f] group-hover:text-[#0071e3] transition-colors leading-snug">
                    {{ $build->title }}
                </h3>
                <p class="mt-1 text-xs text-[#86868b]">
                    von {{ $build->user->name }} · {{ $build->created_at->format('d.m.Y') }}
                </p>
            </div>
            <span class="shrink-0 rounded-full bg-black/[0.04] px-3 py-1 text-xs font-semibold text-[#1d1d1f]">
                {{ number_format($build->total_price, 2, ',', '') }} CHF
            </span>
        </div>

        <div class="mt-4 flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#f5f5f7] px-2.5 py-1 text-[11px] font-medium text-[#6e6e73]">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>{{ $build->products_count }} Komponenten</span>
            </span>
        </div>
    </div>

    <div class="mt-6 flex-1 flex items-end">
        <a href="{{ $href ?? route('builds.show', $build) }}"
            class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-black/[0.05] hover:bg-[#1d1d1f] hover:text-white px-4 py-2.5 text-center text-xs font-semibold text-[#1d1d1f] transition-all duration-200 active:scale-95">
            <span>Build ansehen</span>
            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
</div>

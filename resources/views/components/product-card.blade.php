@props(['product', 'isSelected' => false])

@php
    $spec = $product->specs;
    $lines = [];

    switch ($product->category->slug) {
        case 'cpu':
            $lines[] = 'Socket '.($spec['socket'] ?? '?');
            $lines[] = ($spec['cores'] ?? '?').' Kerne / '.($spec['threads'] ?? '?').' Threads';
            $lines[] = 'Boost: '.($spec['boost_clock'] ?? '?');
            $lines[] = 'TDP: '.($spec['tdp'] ?? '?');
            break;
        case 'mainboard':
            $lines[] = 'Socket '.($spec['socket'] ?? '?').' · '.($spec['chipset'] ?? '?');
            $lines[] = 'Formfaktor: '.($spec['form_factor'] ?? '?');
            $lines[] = ($spec['memory_type'] ?? '?').' · '.($spec['memory_slots'] ?? '?').' Slots · max. '.($spec['memory_max'] ?? '?').' GB';
            break;
        case 'ram':
            $lines[] = 'Typ: '.($spec['type'] ?? '?').' · '.($spec['speed'] ?? '?');
            $lines[] = 'Kapazität: '.($spec['capacity'] ?? '?').' GB ('.($spec['sticks'] ?? '?').' Riegel)';
            break;
        case 'gpu':
            $lines[] = 'VRAM: '.($spec['vram'] ?? '?').' GB';
            $lines[] = 'Länge: '.($spec['length_mm'] ?? '?').' mm · Verbrauch: '.($spec['wattage'] ?? '?').' W';
            $lines[] = 'Empf. Netzteil: '.($spec['recommended_psu'] ?? '?').' W';
            break;
        case 'netzteil':
            $lines[] = 'Leistung: '.($spec['wattage'] ?? '?').' W';
            $lines[] = 'Effizienz: '.($spec['efficiency'] ?? '?');
            $lines[] = $spec['modular'] ?? false ? 'Voll-modular' : 'Nicht modular';
            break;
        case 'ssd':
            $lines[] = 'Kapazität: '.($spec['capacity_gb'] ?? '?').' GB';
            $lines[] = ($spec['interface'] ?? '?').' · '.($spec['form_factor'] ?? '?');
            break;
        case 'gehaeuse':
            $lines[] = 'Formfaktor: '.($spec['form_factor'] ?? '?');
            $lines[] = 'GPU max.: '.($spec['max_gpu_length'] ?? '?').' mm';
            $lines[] = 'PSU max.: '.($spec['max_psu_length'] ?? '?').' mm';
            break;
    }
@endphp

<div class="group relative flex flex-col justify-between rounded-3xl border transition-all duration-300 p-5 sm:p-6
    {{ $isSelected
        ? 'border-[#0071e3] bg-gradient-to-b from-[#f7faff] to-white shadow-[0_8px_30px_rgba(0,113,227,0.12)] ring-1 ring-[#0071e3]'
        : 'border-black/[0.06] bg-white shadow-apple hover:shadow-apple-hover hover:-translate-y-0.5' }}">

    <div>
        <!-- Card Header: Category & Price -->
        <div class="flex items-start justify-between gap-3">
            <div>
                <span class="inline-block text-[11px] font-semibold uppercase tracking-wider text-[#86868b]">
                    {{ $product->category->name }}
                </span>
                <h3 class="mt-1 font-semibold text-[15px] leading-snug text-[#1d1d1f]">
                    {{ $product->name }}
                </h3>
            </div>
            <div class="flex shrink-0 flex-col items-end gap-1.5">
                <span class="rounded-full bg-black/[0.05] px-3 py-1 text-xs font-semibold text-[#1d1d1f]">
                    {{ number_format($product->price, 2, ',', '') }} CHF
                </span>
                @if ($product->url)
                    <a href="{{ $product->url }}" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-[11px] font-medium text-[#0071e3] hover:bg-[#0071e3]/10 transition">
                        <span>Digitec</span>
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        <!-- Specifications Pill Box -->
        <div class="mt-4 rounded-2xl bg-[#fbfbfd] p-3 border border-black/[0.03]">
            <ul class="space-y-1 text-xs text-[#6e6e73]">
                @foreach ($lines as $line)
                    <li class="flex items-center gap-2">
                        <span class="h-1 w-1 rounded-full bg-[#86868b]"></span>
                        <span class="truncate">{{ $line }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Action Slot (Button) -->
    <div class="mt-5 flex items-end">
        {{ $slot }}
    </div>
</div>

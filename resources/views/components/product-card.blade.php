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

<div class="flex flex-col rounded-2xl border {{ $isSelected ? 'border-blue-500 bg-blue-100/30' : 'border-gray-200 bg-white' }} p-5 transition hover:border-gray-400">
    <div class="flex items-start justify-between gap-3">
        <div>
            <p class="text-xs font-medium uppercase tracking-wider text-blue-600">{{ $product->category->name }}</p>
            <h3 class="mt-1 font-semibold leading-snug">{{ $product->name }}</h3>
        </div>
        <div class="flex shrink-0 flex-col items-end gap-1.5">
            <p class="rounded-lg bg-gray-200 px-2 py-1 text-sm font-bold text-green-600">
                {{ number_format($product->price, 2, ',', '') }} CHF
            </p>
            @if ($product->url)
                <a href="{{ $product->url }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-1 rounded-lg bg-gray-200/80 px-2 py-1 text-xs font-medium text-blue-700 transition hover:bg-blue-500 hover:text-white">
                    Digitec ↗
                </a>
            @endif
        </div>
    </div>

    <ul class="mt-4 space-y-1 text-xs text-gray-600">
        @foreach ($lines as $line)
            <li>{{ $line }}</li>
        @endforeach
    </ul>

    <div class="mt-5 flex-1 flex items-end">
        {{ $slot }}
    </div>
</div>
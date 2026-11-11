@props(['href' => '#'])

@php
    $path = ltrim((string) parse_url($href, PHP_URL_PATH), '/');
    $active = request()->path() === $path || ($path !== '' && str_starts_with(request()->path(), $path));
    $classes = $active
        ? 'rounded-full bg-black/[0.07] text-[#1d1d1f] font-semibold px-3.5 py-1.5 transition-all duration-200 shadow-sm'
        : 'rounded-full text-[#6e6e73] hover:text-[#1d1d1f] hover:bg-black/[0.04] px-3.5 py-1.5 font-medium transition-all duration-200';
@endphp

<a href="{{ $href }}" {{ $attributes }} class="{{ $classes }}">{{ $slot }}</a>

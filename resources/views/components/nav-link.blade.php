@props(['href' => '#'])

@php
    $path = ltrim((string) parse_url($href, PHP_URL_PATH), '/');
    $active = request()->path() === $path || ($path !== '' && str_starts_with(request()->path(), $path));
    $classes = $active
        ? 'rounded-full bg-black/[0.07] dark:bg-white/[0.12] text-[#1d1d1f] dark:text-[#f5f5f7] font-semibold px-3.5 py-1.5 transition-all duration-200 shadow-sm'
        : 'rounded-full text-[#6e6e73] dark:text-[#a1a1a6] hover:text-[#1d1d1f] dark:hover:text-[#f5f5f7] hover:bg-black/[0.04] dark:hover:bg-white/[0.06] px-3.5 py-1.5 font-medium transition-all duration-200';
@endphp

<a href="{{ $href }}" {{ $attributes }} class="{{ $classes }}">{{ $slot }}</a>

@props(['href' => '#'])

@php
    $path = ltrim((string) parse_url($href, PHP_URL_PATH), '/');
    $active = request()->path() === $path || ($path !== '' && str_starts_with(request()->path(), $path));
    $classes = $active
        ? 'rounded-lg bg-slate-800 px-3 py-2 font-medium text-cyan-300'
        : 'rounded-lg px-3 py-2 text-slate-300 transition hover:bg-slate-800/60 hover:text-cyan-300';
@endphp

<a href="{{ $href }}" {{ $attributes }} class="{{ $classes }}">{{ $slot }}</a>
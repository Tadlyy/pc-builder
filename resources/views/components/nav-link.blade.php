@props(['href' => '#'])

@php
    $path = ltrim((string) parse_url($href, PHP_URL_PATH), '/');
    $active = request()->path() === $path || ($path !== '' && str_starts_with(request()->path(), $path));
    $classes = $active
        ? 'rounded-lg bg-gray-200 px-3 py-2 font-medium text-blue-700'
        : 'rounded-lg px-3 py-2 text-gray-700 transition hover:bg-gray-200/60 hover:text-blue-700';
@endphp

<a href="{{ $href }}" {{ $attributes }} class="{{ $classes }}">{{ $slot }}</a>
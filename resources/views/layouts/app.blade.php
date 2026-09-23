<!DOCTYPE html>
<html lang="de" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PC Builder')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full bg-slate-950 text-slate-100 antialiased">
    <nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-lg font-bold tracking-tight text-cyan-400">
                        PC Builder
                    </a>
                    <div class="hidden md:flex items-center gap-1 text-sm">
                        <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
                        <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
                        <x-nav-link :href="route('builds.public')">Builds entdecken</x-nav-link>
                    </div>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-cyan-400 transition">{{ auth()->user()->name }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg border border-slate-700 px-3 py-1.5 text-slate-300 hover:bg-slate-800 transition">Abmelden</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-slate-300 hover:text-cyan-400 transition">Anmelden</a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-cyan-500 px-3 py-1.5 font-medium text-slate-900 hover:bg-cyan-400 transition">Registrieren</a>
                    @endauth
                </div>
            </div>
        </div>
        <div class="md:hidden border-t border-slate-800">
            <div class="mx-auto max-w-7xl px-4 py-2 flex gap-4 text-sm">
                <x-nav-link :href="route('configurator.index')">Konfigurator</x-nav-link>
                <x-nav-link :href="route('catalog.index')">Katalog</x-nav-link>
                <x-nav-link :href="route('builds.public')">Builds</x-nav-link>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 sm:px-6 py-8">
        @if (session('success'))
            <div class="mb-4 rounded-xl border border-emerald-700/50 bg-emerald-900/40 px-4 py-3 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-xl border border-rose-700/50 bg-rose-900/40 px-4 py-3 text-sm text-rose-200">
                {{ session('error') }}
            </div>
        @endif
        @if (session('share_url'))
            <div class="mb-4 rounded-xl border border-cyan-700/50 bg-cyan-900/40 px-4 py-3 text-sm text-cyan-200">
                <p class="font-semibold mb-1">Dein öffentlicher Teilen-Link:</p>
                <input type="text" readonly value="{{ session('share_url') }}"
                    class="w-full rounded border border-cyan-700 bg-slate-950 px-2 py-1 text-cyan-100"
                    onclick="this.select()">
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        PC Builder Konfigurator – Laravel-Projekt · Kompatibilitätsprüfung für CPU, Mainboard, RAM, GPU &amp; Netzteil
    </footer>
</body>
</html>
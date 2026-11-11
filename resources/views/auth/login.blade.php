@extends('layouts.app')

@section('title', 'Anmelden')

@section('content')
    <div class="mx-auto max-w-[420px] py-6 sm:py-10 animate-fade-in-up">
        <div class="rounded-3xl border border-black/[0.06] dark:border-white/[0.08] bg-white dark:bg-[#161618] p-8 sm:p-10 shadow-apple dark:shadow-apple-dark">
            <!-- Icon & Header -->
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-[#1d1d1f] dark:bg-white text-white dark:text-[#1d1d1f] shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                </div>
                <h1 class="mt-4 text-2xl font-bold tracking-tight text-[#1d1d1f] dark:text-[#f5f5f7]">Anmelden</h1>
                <p class="mt-1 text-xs sm:text-sm text-[#86868b] dark:text-[#a1a1a6]">Melde dich an, um deine PC-Builds zu verwalten.</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-red-200/80 dark:border-red-500/30 bg-red-50/70 dark:bg-red-950/30 p-4 text-xs text-red-900 dark:text-red-200">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-1.5">
                                <span class="h-1 w-1 rounded-full bg-red-500"></span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] dark:text-[#a1a1a6]">E-Mail-Adresse</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="deine.email@beispiel.ch"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] dark:border-white/[0.1] bg-[#fbfbfd] dark:bg-[#1c1c1e] px-4 py-3 text-sm text-[#1d1d1f] dark:text-[#f5f5f7] placeholder-[#86868b] dark:placeholder-[#737378] shadow-inner focus:bg-white dark:focus:bg-[#1c1c1e] focus:border-[#0071e3] dark:focus:border-[#2997ff] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 dark:focus:ring-[#2997ff]/20 transition">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b] dark:text-[#a1a1a6]">Passwort</label>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] dark:border-white/[0.1] bg-[#fbfbfd] dark:bg-[#1c1c1e] px-4 py-3 text-sm text-[#1d1d1f] dark:text-[#f5f5f7] placeholder-[#86868b] dark:placeholder-[#737378] shadow-inner focus:bg-white dark:focus:bg-[#1c1c1e] focus:border-[#0071e3] dark:focus:border-[#2997ff] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 dark:focus:ring-[#2997ff]/20 transition">
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 text-xs text-[#6e6e73] dark:text-[#a1a1a6] cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-black/[0.15] dark:border-white/[0.2] text-[#0071e3] dark:text-[#2997ff] focus:ring-[#0071e3]/20">
                        <span>Angemeldet bleiben</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center rounded-full bg-[#0071e3] py-3 px-4 text-sm font-semibold text-white shadow-sm hover:bg-[#0077ed] dark:hover:bg-[#2997ff] transition-all duration-200 hover:shadow active:scale-[0.98]">
                    Anmelden
                </button>
            </form>

            <div class="mt-8 border-t border-black/[0.06] dark:border-white/[0.08] pt-6 text-center text-xs text-[#86868b] dark:text-[#a1a1a6]">
                <span>Noch kein Konto?</span>
                <a href="{{ route('register') }}" class="font-semibold text-[#0071e3] dark:text-[#2997ff] hover:underline ml-1">Kostenlos registrieren</a>
            </div>
        </div>
    </div>
@endsection

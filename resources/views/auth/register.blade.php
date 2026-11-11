@extends('layouts.app')

@section('title', 'Konto erstellen')

@section('content')
    <div class="mx-auto max-w-[440px] py-6 sm:py-10 animate-fade-in-up">
        <div class="rounded-3xl border border-black/[0.06] bg-white p-8 sm:p-10 shadow-apple">
            <!-- Icon & Header -->
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-[#1d1d1f] text-white shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h1 class="mt-4 text-2xl font-bold tracking-tight text-[#1d1d1f]">Konto erstellen</h1>
                <p class="mt-1 text-xs sm:text-sm text-[#86868b]">Erstelle einen Account, um deine PC-Zusammenstellungen dauerhaft zu sichern.</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mt-6 rounded-2xl border border-red-200/80 bg-red-50/70 p-4 text-xs text-red-900">
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
            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b]">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        placeholder="Max Muster"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] bg-[#fbfbfd] px-4 py-3 text-sm text-[#1d1d1f] placeholder-[#86868b] shadow-inner focus:bg-white focus:border-[#0071e3] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 transition">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b]">E-Mail-Adresse</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        placeholder="max.muster@beispiel.ch"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] bg-[#fbfbfd] px-4 py-3 text-sm text-[#1d1d1f] placeholder-[#86868b] shadow-inner focus:bg-white focus:border-[#0071e3] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 transition">
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b]">Passwort</label>
                    <input id="password" type="password" name="password" required
                        placeholder="Mindestens 8 Zeichen"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] bg-[#fbfbfd] px-4 py-3 text-sm text-[#1d1d1f] placeholder-[#86868b] shadow-inner focus:bg-white focus:border-[#0071e3] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 transition">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-[#86868b]">Passwort wiederholen</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="Passwort erneut eingeben"
                        class="mt-1.5 w-full rounded-2xl border border-black/[0.08] bg-[#fbfbfd] px-4 py-3 text-sm text-[#1d1d1f] placeholder-[#86868b] shadow-inner focus:bg-white focus:border-[#0071e3] focus:outline-none focus:ring-4 focus:ring-[#0071e3]/10 transition">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center rounded-full bg-[#0071e3] py-3 px-4 text-sm font-semibold text-white shadow-sm hover:bg-[#0077ed] transition-all duration-200 hover:shadow active:scale-[0.98]">
                        Registrieren
                    </button>
                </div>
            </form>

            <div class="mt-8 border-t border-black/[0.06] pt-6 text-center text-xs text-[#86868b]">
                <span>Bereits ein Konto?</span>
                <a href="{{ route('login') }}" class="font-semibold text-[#0071e3] hover:underline ml-1">Jetzt anmelden</a>
            </div>
        </div>
    </div>
@endsection

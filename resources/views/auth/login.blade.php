@extends('layouts.app')

@section('title', 'Anmelden')

@section('content')
    <div class="mx-auto max-w-md">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-8">
            <h1 class="text-2xl font-bold">Anmelden</h1>
            <p class="mt-1 text-sm text-slate-400">Logge dich ein, um deine Builds zu speichern.</p>

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-rose-700/50 bg-rose-900/40 px-4 py-3 text-sm text-rose-200">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">Passwort</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-400">
                    <input type="checkbox" name="remember">
                    Angemeldet bleiben
                </label>

                <button type="submit"
                    class="w-full rounded-lg bg-cyan-500 px-4 py-2.5 font-semibold text-slate-900 hover:bg-cyan-400 transition">
                    Anmelden
                </button>
            </form>

            <p class="mt-6 text-sm text-slate-400">
                Noch kein Konto?
                <a href="{{ route('register') }}" class="font-medium text-cyan-400 hover:text-cyan-300">Registrieren</a>
            </p>
        </div>
    </div>
@endsection
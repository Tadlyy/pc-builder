@extends('layouts.app')

@section('title', 'Registrieren')

@section('content')
    <div class="mx-auto max-w-md">
        <div class="rounded-2xl border border-slate-800 bg-slate-900 p-8">
            <h1 class="text-2xl font-bold">Konto erstellen</h1>
            <p class="mt-1 text-sm text-slate-400">Speichere und teile deine PC-Zusammenstellungen.</p>

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-rose-700/50 bg-rose-900/40 px-4 py-3 text-sm text-rose-200">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300">Passwort</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-300">Passwort bestätigen</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="mt-1 w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100 focus:border-cyan-500 focus:outline-none">
                </div>

                <button type="submit"
                    class="w-full rounded-lg bg-cyan-500 px-4 py-2.5 font-semibold text-slate-900 hover:bg-cyan-400 transition">
                    Registrieren
                </button>
            </form>

            <p class="mt-6 text-sm text-slate-400">
                Bereits registriert?
                <a href="{{ route('login') }}" class="font-medium text-cyan-400 hover:text-cyan-300">Anmelden</a>
            </p>
        </div>
    </div>
@endsection
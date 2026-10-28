@extends('layouts.app')

@section('title', 'Anmelden')

@section('content')
    <div class="mx-auto max-w-md">
        <div class="rounded-2xl border border-black/5 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8">
            <h1 class="text-2xl font-bold">Anmelden</h1>
            <p class="mt-1 text-sm text-gray-600">Logge dich ein, um deine Builds zu speichern.</p>

            @if ($errors->any())
                <div class="mt-4 rounded-xl border border-red-300/50 bg-red-100/40 px-4 py-3 text-sm text-red-800">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-Mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Passwort</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:outline-none">
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember">
                    Angemeldet bleiben
                </label>

                <button type="submit"
                    class="w-full rounded-lg bg-blue-500 px-4 py-2.5 font-semibold text-white hover:bg-blue-600 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 active:scale-95">
                    Anmelden
                </button>
            </form>

            <p class="mt-6 text-sm text-gray-600">
                Noch kein Konto?
                <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700">Registrieren</a>
            </p>
        </div>
    </div>
@endsection
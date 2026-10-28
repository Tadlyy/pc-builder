@extends('layouts.app')

@section('title', 'Builds entdecken')

@section('content')
    <h1 class="text-2xl font-bold">Öffentliche Builds entdecken</h1>
    <p class="mt-1 text-sm text-gray-600">Von der Community erstellte PC-Zusammenstellungen.</p>

    @if ($builds->isEmpty())
        <div class="mt-8 rounded-2xl border border-gray-200 bg-white p-8 text-center text-sm text-gray-600">
            Noch keine öffentlichen Builds. Erstelle deinen eigenen!
        </div>
    @else
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($builds as $build)
                <x-build-card :build="$build" :href="route('builds.shared', $build->share_token)" />
            @endforeach
        </div>
    @endif
@endsection
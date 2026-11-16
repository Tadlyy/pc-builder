<?php

use App\Services\DigitecSyncService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $service = app(DigitecSyncService::class);
    $results = $service->syncAll();

    Log::info('DigitecSync: täglicher Abgleich abgeschlossen', [
        'updated' => $results['updated'],
        'deleted' => $results['deleted'],
        'errors' => $results['errors'],
    ]);
})->daily()->at('03:00')
    ->name('digitec-sync-all')
    ->withoutOverlapping(120)
    ->description('Alle Produkte mit Digitec abgleichen');

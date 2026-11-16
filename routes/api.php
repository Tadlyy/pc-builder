<?php

use App\Http\Controllers\Api\DigitecSyncController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('digitec')->group(function () {
    Route::post('/sync/{product}', [DigitecSyncController::class, 'sync'])
        ->name('api.digitec.sync');
    Route::post('/sync-all', [DigitecSyncController::class, 'syncAll'])
        ->name('api.digitec.sync-all');
});

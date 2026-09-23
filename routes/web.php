<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\BuildController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ConfiguratorController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{category}', [CatalogController::class, 'show'])->name('catalog.category');

Route::get('/configurator', [ConfiguratorController::class, 'index'])->name('configurator.index');
Route::post('/configurator/add/{product}', [ConfiguratorController::class, 'add'])->name('configurator.add');
Route::post('/configurator/remove/{product}', [ConfiguratorController::class, 'remove'])->name('configurator.remove');
Route::post('/configurator/clear', [ConfiguratorController::class, 'clear'])->name('configurator.clear');

Route::get('/builds', [BuildController::class, 'public'])->name('builds.public');
Route::get('/builds/shared/{token}', [BuildController::class, 'shared'])->name('builds.shared');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/builds', [BuildController::class, 'store'])->name('builds.store');
    Route::get('/builds/{build}', [BuildController::class, 'show'])->name('builds.show');
    Route::post('/builds/{build}/share', [BuildController::class, 'share'])->name('builds.share');
    Route::delete('/builds/{build}', [BuildController::class, 'destroy'])->name('builds.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

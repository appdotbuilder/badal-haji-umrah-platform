<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page with featured providers
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public service provider listing
Route::get('/service-providers', [ServiceProviderController::class, 'index'])->name('service-providers.index');
Route::get('/service-providers/{provider}', [ServiceProviderController::class, 'show'])->name('service-providers.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Service Provider Management
    Route::resource('service-providers', ServiceProviderController::class)->except(['index', 'show']);
    
    // Order Management
    Route::resource('orders', OrderController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
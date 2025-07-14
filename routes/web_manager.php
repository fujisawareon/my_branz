<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Manager\DashboardController;

// 管理者ログイン
Route::prefix('manager')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('manager_login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('manager_login');
    });

    Route::middleware('auth:managers')->group(function () {
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('manager_logout');

        Route::get('dashboard', DashboardController::class)->name('manager_dashboard');
    });
});

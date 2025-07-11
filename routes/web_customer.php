<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\Auth\AuthenticatedSessionController;


// 顧客ログイン
Route::prefix('customer')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('customer_login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('customer_login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

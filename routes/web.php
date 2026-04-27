<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// ─── Public ───────────────────────────────────────────────────────────────────

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// ─── Auth ─────────────────────────────────────────────────────────────────────

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Backoffice (admin only) ───────────────────────────────────────────────────

Route::prefix('backoffice')
    ->middleware(['auth', AdminMiddleware::class])
    ->name('backoffice.')
    ->group(function () {
        Route::get('/', [BackofficeController::class, 'index'])->name('index');
    });
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Api\TestSubmissionController;
use App\Http\Controllers\Api\CityController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\InstructionController;

// ─── Public ───────────────────────────────────────────────────────────────────

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Compatibility route for Laravel auth middleware redirect
// Some middleware redirects to route('login') when unauthenticated.
// We map it to the landing page and add a query flag to trigger the modal.
Route::get('/login', function () {
    return redirect()->to(route('dashboard') . '?showLogin=1');
})->name('login');

// ─── Auth ─────────────────────────────────────────────────────────────────────

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Registrasi
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// ─── Student Routes (Authenticated Only) ───────────────────────────────────────

Route::prefix('student')
    ->middleware('auth')
    ->name('student.')
    ->group(function () {
        Route::get('/instruction', [InstructionController::class, 'index'])->name('index');
        Route::get('/test', [TestController::class, 'index'])->name('test');
        Route::post('/test/submit', [TestSubmissionController::class, 'submit'])->name('test.submit');
        Route::get('/test/attempts', [TestSubmissionController::class, 'getUserAttempts'])->name('test.attempts');
        Route::get('/test/attempts/{attemptId}', [TestSubmissionController::class, 'getAttemptDetails'])->name('test.attempt.detail');
    });

// Public routes
Route::get('/cities/search', [CityController::class, 'searchCity'])->name('cities.search');
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');

// ─── Backoffice (admin only) ───────────────────────────────────────────────────

Route::prefix('backoffice')
    ->middleware(['auth', AdminMiddleware::class])
    ->name('backoffice.')
    ->group(function () {
        Route::get('/', [BackofficeController::class, 'index'])->name('index');
        Route::get('/question', [QuestionController::class, 'index'])->name('question');
        Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
        Route::post('/question', [QuestionController::class, 'store'])->name('questions.store');
        Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
        Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
        Route::put('/question/{question}', [QuestionController::class, 'update'])->name('questions.update');
        Route::get('/question/{question}', [QuestionController::class, 'show'])->name('question.show');
    });
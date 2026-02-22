<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Google Auth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ResumeController::class, 'index'])->name('dashboard');

    // Resume Generation Flow
    Route::prefix('resume')->name('resume.')->group(function () {
        Route::get('/create', [ResumeController::class, 'create'])->name('create');
        Route::post('/store-info', [ResumeController::class, 'storeInfo'])->name('store-info');
        Route::get('/select-context', [ResumeController::class, 'selectContext'])->name('select-context');
        Route::post('/generate', [ResumeController::class, 'generate'])->name('generate');
        Route::get('/{resume}/edit', [ResumeController::class, 'edit'])->name('edit');
        Route::put('/{resume}', [ResumeController::class, 'update'])->name('update');
        Route::get('/{resume}/export', [ResumeController::class, 'export'])->name('export');
    });

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
        Route::get('/templates', [AdminController::class, 'templates'])->name('templates');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    });
});

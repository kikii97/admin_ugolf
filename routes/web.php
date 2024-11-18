<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TrxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/merchant/index', [MerchantController::class, 'index']);
Route::post('/merchant', [MerchantController::class, 'store']);
Route::put('/merchant/{id}', [MerchantController::class, 'update']);

Route::get('/terminal', [TerminalController::class, 'index'])->name('terminal.index');
Route::post('/terminal', [TerminalController::class, 'store']);
Route::put('/terminal/{id}', [TerminalController::class, 'update']);

Route::get('/payment-type', function () {
    return view('payment_type');
});

Route::get('/trx', [TrxController::class, 'index']);
Route::post('/trx', [TrxController::class, 'store']);
Route::put('/trx/{id}', [TrxController::class, 'update']);

Route::get('/cms', function () {
    return view('cms');
});

// Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
// });

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TrxController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/merchant/index', [MerchantController::class, 'index']);
Route::post('/merchant', [MerchantController::class, 'store']);
Route::put('/merchant/{id}', [MerchantController::class, 'update']);

Route::get('/terminal', [TerminalController::class, 'index']);
Route::post('/terminal', [TerminalController::class, 'store']);
Route::put('/terminal/{id}', [TerminalController::class, 'update']);

Route::get('/trx', [TerminalController::class, 'index']);
Route::post('/trx', [TerminalController::class, 'store']);
Route::put('/trx/{id}', [TerminalController::class, 'update']);

Route::get('/payment-type', function () {
    return view('payment_type');
});

Route::get('/cms', [TerminalController::class, 'index']);
Route::post('/cms', [TerminalController::class, 'store']);
Route::put('/cms/{id}', [TerminalController::class, 'update']);

Route::get('/transaction', function () {
    return view('transaction/transaction');
});

Route::get('/tiket', function () {
    return view('ticket_price');
});

Route::get('/lokasi', function () {
    return view('location');
});

Route::get('/lokasi/create', function () {
    return view('lokasi/index');
});

// Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
// });

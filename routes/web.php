<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TrxController;
use App\Http\Controllers\LoketingController;
use App\Http\Controllers\LokasiController;


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

Route::get('/transaction', function () {
    return view('transaction');
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

Route::get('/loketing', [LoketingController::class, 'create'])->name('loketing.create');
Route::get('/loketing', [LoketingController::class, 'store'])->name('loketing.store');


Route::get('/loketing', [LoketingController::class, 'index']);
Route::get('/loketing/create', [LoketingController::class, 'create'])->name('loket.data');

Route::get('/tambahlokasi', [LokasiController::class, 'index'])->name('lokasi.index');
Route::get('/lokasi/data', [LokasiController::class, 'getData'])->name('lokasi.data');
Route::post('/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store');

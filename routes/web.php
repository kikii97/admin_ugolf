<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoketingController;
use App\Http\Controllers\DetailController;
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

// Route for displaying ticket details
Route::get('/loketing/detail', [DetailController::class, 'showDetails'])->name('details');

Route::get('/loketing', [LoketingController::class, 'index']);
Route::get('/loketing/create', [LoketingController::class, 'create'])->name('loket.data');

Route::get('/tambahlokasi', [LokasiController::class, 'index'])->name('lokasi.index');
Route::get('/lokasi/data', [LokasiController::class, 'getData'])->name('lokasi.data');
Route::post('/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store');

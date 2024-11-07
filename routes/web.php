<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoketingController;
use App\Http\Controllers\DetailController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('index');
});


Route::get('/loketing', [LoketingController::class, 'create'])->name('loketing.create');
Route::get('/loketing', [LoketingController::class, 'store'])->name('loketing.store');


// Route for displaying ticket details
Route::get('/loketing/detail', [DetailController::class, 'showDetails'])->name('details');


Route::get('/loketing', [LoketingController::class, 'index']);
Route::get('/loketing/create', [LoketingController::class, 'getLoketData'])->name('loket.data');

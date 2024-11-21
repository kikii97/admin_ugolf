<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TerminalController;
use App\Http\Controllers\TrxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
Route::middleware('jwt_token')->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/create', [RoleController::class, 'create']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit']);
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/assign', [RoleController::class, 'indexAssignRole']);
    Route::put('/roles/assign/{user}', [RoleController::class, 'assignRole'])->name('roles.assign');


    // Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    // });
});
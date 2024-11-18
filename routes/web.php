<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
});

require __DIR__.'/auth.php';

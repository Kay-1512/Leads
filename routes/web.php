<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
// });

require __DIR__.'/auth.php';

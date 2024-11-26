<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('client.show');
    Route::get('clients/{client}/new-lead', [LeadController::class, 'create'])->name('lead.new-lead');
    Route::get('/new-client', [ClientController::class, 'create'])->name('new-client');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('edit-client');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('client.update');


Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::post('/store-lead', [LeadController::class, 'store'])->name('lead.store');
Route::post('/store-client', [ClientController::class, 'store'])->name('client.store');



});

require __DIR__.'/auth.php';
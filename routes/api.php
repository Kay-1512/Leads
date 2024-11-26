<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadStageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/leads', [LeadStageController::class, 'index'])->name('api.leads.index');
Route::post('/lead/stage/update', [LeadStageController::class, 'update'])->name('lead.stage.update');


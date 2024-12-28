<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadStageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/sso/validate-token', function (Request $request) {
    $request->validate([
        'token' => 'required',
    ]);

    $personalAccessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($request->input('token'));

    if (!$personalAccessToken) {
        return response()->json(['message' => 'Invalid or expired token'], 401);
    }

    $user = $personalAccessToken->tokenable;

    return response()->json([
        'success' => true,
        'user' => [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->full_name,
        ],
    ]);
});

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\LeadStageController;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

Route::get('/', function () {
    return redirect('dashboard');
})->name('/');

Route::post('/sso/share', function (Request $request) {
    return response()->json([
        'email' => Auth::user()->email,
    ]);
})->middleware('auth:sanctum');

Route::get('/sso/validate', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'token' => 'required',
    ]);

    $token = $request->input('token');
    Log::info('Received Token:', ['token' => $token]);

    // Call App A to validate the token
    $response = Http::post(env('PANDABOT_URL') . '/api/sso/validate-token', [
        'token' => $token,
    ]);

    if ($response->status() !== 200) {
        Log::warning('Invalid or expired token.', ['token' => $token]);
        return response()->json(['message' => 'Invalid or expired token.'], 401);
    }

    $data = $response->json();

    // Log the user into App B using the validated user data
    $user = \App\Models\User::firstOrCreate([
        'email' => $data['user']['email'],
    ], [
        'name' => $data['user']['name'],
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::get('/sso/switch-to-pandabot', function () {
    $token = Auth::user()->createToken('SP Portal Token')->plainTextToken;
    return redirect(env('PANDABOT_URL') . '/sso/validate?token=' . $token);
})->middleware('auth')->name('sso.switch_to_pandabot');

Route::middleware(['auth', 'auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

    Route::get('/clients/{client}/lead-stages', [LeadStageController::class, 'index']);
    Route::post('/lead/stage/update', [LeadStageController::class, 'update'])->name('lead.stage.update');
    // Routes in web.php or api.php

    // Get sticky notes for a specific client (only the logged-in user and admins can see them)
    Route::get('/clients/{client}/notes', [NoteController::class, 'getNotes']);

    // Store a sticky note for a specific client (user-specific)
    Route::post('/clients/{client}/note', [NoteController::class, 'store'])->name('note.store');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('note.update');

    // Delete a specific sticky note (user-specific, only the creator or an admin can delete)
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('note.delete');
});

require __DIR__ . '/auth.php';

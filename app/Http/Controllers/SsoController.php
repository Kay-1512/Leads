<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\NewAccessToken;


class SsoController extends Controller
{
    public function redirectToPandaBot()
    {
        if (!Auth::check()) {
            return back()->withErrors(['message' => 'User is not authenticated.']);
        }

        // Generate a token for the user
        $user = Auth::user();
        $token = $user->createToken('SSO Token')->plainTextToken;

        // Redirect to App B with the token
        return redirect(env('PANDABOT_URL') . '/sso/validate?token=' . $token);
    }

}
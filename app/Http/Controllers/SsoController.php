<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SsoController extends Controller
{
    public function redirectToPandaBot()
    {
        $response = Http::post(env('PANDABOT_URL') . '/sso/share', [
            'email' => Auth::user()->email,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return redirect(env('PANDABOT_URL') . '/sso/validate?email=' . $data['email'] . '&token=' . $data['token']);
        }

        return back()->withErrors(['message' => 'Unable to switch to Panda BOT']);
    }

}

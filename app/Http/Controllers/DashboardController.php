<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $user = Auth::user();

        return view("pages.dashboard");

        if (auth()->user()->hasRole("admin")) {
            return view("");
        } elseif (auth()->user()->hasRole("")) {
            return view("");
        } elseif (auth()->user()->hasRole("")) {
            return view("");
        }

    }
}

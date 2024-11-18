<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user()->get();

        $users = User::paginate(10);

        // dd($user);
        
        return view("pages.dashboard", compact("users", "user"));
    }
}

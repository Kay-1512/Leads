<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Lead;

use App\Models\LeadStage;
use Auth;

class DashboardController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $leads = Lead::all();

        $users = User::paginate(10);

        // dd(User::all());

        // dd($user);

        return view("pages.dashboard", compact("users", "user", "leads"));
    }
}

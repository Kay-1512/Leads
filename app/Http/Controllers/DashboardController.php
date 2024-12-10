<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');  
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        $users = User::with('leads') 
            ->paginate(10); 

        $users = $users->getCollection()->sortByDesc(function ($user) {
            return $user->leads->sum('revenue');
        });

        $users = new \Illuminate\Pagination\LengthAwarePaginator(
            $users, 
            $users->count(), 
            10, 
            request()->input('page', 1), 
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('pages.dashboard', compact('users', 'user'));
    }
}

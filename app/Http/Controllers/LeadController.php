<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Client;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $leads = Lead::all();
        return view("pages.leads.index", compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Client $client)
    {
        // dd($client);
        $roles = Role::all();

        return view("pages.leads.new-lead", compact("client"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        // Create the lead
        dd($request->all());
        $validated = $request->validate([

            'number_of_users' => 'nullable|integer',
            'potential_revenue' => 'nullable|numeric',
            'referral' => 'nullable|in:1,2', 
            'referrer_name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $lead = Lead::create([
            'number_of_users'=> $validated['number_of_users'],
            'potential_revenue'=> $validated['potential_revenue'],
            'referral'=> $validated['referral'],
            'referrer_name'=> $validated['referrer_name'],
            'description'=> $validated['description'],

        ]);

        return view('pages.leads')->with('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        //
    }
}

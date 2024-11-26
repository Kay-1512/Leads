<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Client;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;


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
        // dd($request->all());
        $validated = $request->validate([
            'title' => 'string',
            'potential_users' => 'nullable|integer',
            'revenue' => 'nullable|numeric',
            'is_referral' => 'nullable|in:1,0',
            'referrer' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $lead = Lead::create([
            'title' => $validated['title'],
            'potential_users' => $validated['potential_users'],
            'revenue' => $validated['revenue'],
            'is_referral' => $validated['is_referral'],
            'referrer' => $validated['referrer'],
            'description' => $validated['description'],
            'client_id' => $request['client_id'],
            'lead_stage_id' => 1,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('leads')->with('success','');
    }

    /**
     * Display the specified resource.
     */
    public function show($clientId)
    {
        // Fetch the client by ID
        $client = Client::findOrFail($clientId);

        // Fetch the leads related to this client
        $leads = Lead::where('client_id', $clientId)->get();

        // Pass client and leads to the view
        return view('pages.clients.show', compact('client', 'leads'));
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

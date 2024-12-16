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


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lead_stage_id' => 'nullable|exists:lead_stages,id',
            'is_referral' => 'boolean',
            'referrer' => 'nullable|string',
            'revenue' => 'nullable|numeric',
            'potential_users' => 'nullable|numeric',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Find the current highest order in the stage
        $highestOrder = Lead::where('lead_stage_id', $validated['lead_stage_id'])
            ->max('order') ?? 0;

        // Create the lead with the incremented order
        $lead = Lead::create(array_merge($validated, [
            'order' => $highestOrder + 1,
        ]));

        return redirect()->route('leads')->with('success', '');
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

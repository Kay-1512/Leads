<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd(Client::all());
        $clients = Client::all();

        return view("pages.clients.index", compact("clients"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.clients.new-client");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the client and lead data
        $validated = $request->validate([
            'companyName' => 'required|string|max:255',
            'contactPerson' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|numeric',
            'number_of_users' => 'nullable|integer',
            'potential_revenue' => 'nullable|numeric',
            'referral' => 'nullable|in:1,2', // '1' for Yes, '2' for No
            'referrer_name' => 'nullable|string', // Referrer name
        ]);
    
        // Create the client
        $client = Client::create([
            'companyName' => $validated['companyName'],
            'contactPerson' => $validated['contactPerson'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);
    
        // If lead data is provided, store it in the Lead model
        if ($validated['referral'] === '1') { // If 'Yes' is selected for referral
            $referrer_name = $validated['referrer_name'] ?? null;
        } else {
            $referrer_name = null;
        }
    
        // Create a new lead related to the client
        $lead = new Lead();
        $lead->client_id = $client->id;
        $lead->number_of_users = $validated['number_of_users'] ?? null;
        $lead->potential_revenue = $validated['potential_revenue'] ?? null;
        $lead->referral = $validated['referral'] == '1' ? 'Yes' : 'No';
        $lead->referrer_name = $referrer_name;
        $lead->description = $validated['description'] ?? null;
        $lead->save();
    
        // Redirect with success message
        return redirect()->route('clients')->with('success', 'Client and lead added successfully!');
    }
        /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load("leads");

        return view("pages.clients.show", compact("client"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {

        // Pass the client data to the view
        return view('pages.clients.edit-client', compact('client'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'companyName' => 'required|string|max:255',
            'contactPerson' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id, // Ensures current client email is allowed
            'phone' => 'required|numeric',
        ]);

        $client->update([
            'companyName' => $validated['companyName'],
            'contactPerson' => $validated['contactPerson'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        $client->update($validated);

        return redirect()->route('client.show', $client)->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
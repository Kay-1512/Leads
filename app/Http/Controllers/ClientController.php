<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Province;
use Illuminate\Http\Request;
use Auth;

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
        $provinces = Province::all();

        return view("pages.clients.create", compact("provinces"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the client and lead data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'colour' => 'nullable|string',
            'representative_id' => 'nullable|integer',
            'sales_person_id' => 'required|integer',
            'province_id' => 'required',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required',
            'number_of_users' => 'nullable|integer',
            'potential_revenue' => 'nullable|numeric',
            'referral' => 'nullable|in:1,2', // '1' for Yes, '2' for No
            'referrer_name' => 'nullable|string', // Referrer name
        ]);

        // Create the client
        $client = Client::create($validated);

        return redirect()->route('clients')->with('success', 'Client and lead added successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load(['leads', 'notes']);

        $isSalesPerson = false;


        if ($client->sales_person_id == Auth::user()->id) {
            $isSalesPerson = true;
        }

        return view('pages.clients.show', compact("client", "isSalesPerson"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {

        // Pass the client data to the view
        return view('pages.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'contact_person_id' => 'required|integer',
            'email' => 'required|email|unique:clients,email,' . $client->id, // Ensures current client email is allowed
            'phone' => 'required',
        ]);

        $client->update([
            'name' => $validated['name'],
            // 'contact_person_id' => $validated['contact_person_id'],
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

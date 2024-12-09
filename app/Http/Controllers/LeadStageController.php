<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Client;
use App\Models\LeadStage;
use Illuminate\Http\Request;
use Log;

class LeadStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {

        $user = auth()->user();

        // $stages = LeadStage::with(['leads.client' => function ($query) {
        //     $query->orderBy('order');
        // }])->orderBy('order')->get();

        // $leads = Lead::with(['stage', 'client'])
        //     ->where('client_id', $client->id)
        //     ->get();

        $stages = LeadStage::with([
            'leads' => function ($query) use ($client, $user) {
                $query->where('client_id', $client->id)
                ->where('user_id', $user->id)->orderBy('order');
            }
        ])->orderBy('order')
        ->get();

        // dd(vars: $stages);


        return response()->json($stages);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // Validate the incoming data
            $validated = $request->validate([
                'leads' => 'required|array',
                'leads.*.id' => 'required|exists:leads,id',
                'leads.*.lead_stage_id' => 'required|exists:lead_stages,id', // Ensure lead_stage_id exists
                'leads.*.order' => 'required|integer', // Ensure order is an integer
            ]);

            // Debug incoming payload
            Log::info('Leads Update Payload:', $validated['leads']);

            // Update each lead
            foreach ($validated['leads'] as $lead) {
                $updated = Lead::where('id', $lead['id'])->update([
                    'lead_stage_id' => $lead['lead_stage_id'], // Update the stage
                    'order' => $lead['order'], // Update the order
                ]);

                // Log the result of each update
                Log::info("Updated Lead ID {$lead['id']}:", ['updated' => $updated]);
            }

            return response()->json(['message' => 'Order updated successfully.']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

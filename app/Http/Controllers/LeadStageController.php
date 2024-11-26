<?php

namespace App\Http\Controllers;

use App\Models\LeadStage;
use Illuminate\Http\Request;

class LeadStageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = LeadStage::with(['leads' => function ($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();
    
        return response()->json($stages);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeadStage $leadStage)
    {
        $validated = $request->validate([
            'leads' => 'required|array',
            'leads.*.id' => 'required|exists:leads,id',
            'leads.*.lead_stage_id' => 'required|exists:lead_stages,id',
            'leads.*.order' => 'required|integer',
        ]);
    
        foreach ($validated['leads'] as $lead) {
            Lead::where('id', $lead['id'])->update([
                'lead_stage_id' => $lead['lead_stage_id'],
                'order' => $lead['order'],
            ]);
        }
    
        return response()->json(['message' => 'Order updated successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadsController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        $leads = Lead::with('contact')->where('business_id', '=', $user->currently_selected_business_id)->orderBy('id', 'desc')->get();
        return response()->json($leads);
    }

    public function store(Request $request)
    {

        $user = auth()->user();

        $validatedData = $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'description' => 'nullable|string',
            'lead_source' => 'nullable|string',
        ]);

        $lead = Lead::create($validatedData);
        $lead->business_id = $user->currently_selected_business_id;
        $lead->save();

        $newLead = Lead::with('contact')->findOrFail($lead->id);
        return response()->json($newLead, 201);
    }

    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return response()->json($lead);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'description' => 'nullable|string',
            'lead_source' => 'nullable|string',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($validatedData);

        return response()->json($lead, 200);
    }

    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return response()->json(null, 204);
    }
}

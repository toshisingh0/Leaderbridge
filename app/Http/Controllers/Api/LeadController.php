<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Events\LeadCreated;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'nullable|string|max:20',
            'source' => 'nullable|string|max:255',
            'follow_up_date' => 'nullable|date|after_or_equal:today',
        ]);

        $lead = Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'source' => $request->source,
            'status' => 'new',
            'follow_up_date' => $request->follow_up_date,
            // 'user_id' => auth()->id(), 
        ]);

        // ✅ EVENT FIRE (AUTO EMAIL TRIGGER)
        event(new LeadCreated($lead));

        return response()->json([
            'message' => 'Lead created & email triggered successfully',
            'data' => $lead
        ], 201);
    }

    public function index(Request $request)
    {
        $leads = Lead::latest()->get();

        if ($request->wantsJson()) {
            // API request
            return response()->json([
                'success' => true,
                'data' => $leads
            ]);
        }

        // Web request
        return view('leads.index', compact('leads'));
    }

       public function show(Request $request, Lead $lead)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $lead
            ]);
        }

        return view('leads.show', compact('lead'));
    }

     public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead')); // Only web
    }

    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update($request->all());

        return response()->json([
            'message' => 'Lead updated successfully',
            'lead' => $lead
        ]);
            return redirect()->route('leads.index')->with('success', 'Lead updated successfully');

    }

    public function destroy(Request $request, Lead $lead)
    {
        $lead->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Lead deleted successfully.'
            ]);
        }

        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }

}

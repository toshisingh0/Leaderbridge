<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\FollowUp;


class FollowUpController extends Controller
{
    public function store(Request $request, Lead $lead)
    {
        $request->validate([
            'follow_up_at' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $lead->followUps()->create([
            'follow_up_at' => $request->follow_up_at,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Follow-up added successfully');
    }


    public function markDone(FollowUp $followUp)
    {
        $followUp->update(['is_done' => 1]);
        return back()->with('success', 'Follow-up marked as done');
    }



}

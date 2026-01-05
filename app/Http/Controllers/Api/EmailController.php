<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // public function sendEmail(Request $request)
    // {
    //     $request->validate([
    //         'to' => 'required|email',
    //         'subject' => 'required|string',
    //         'body' => 'required|string',
    //     ]);

    //     Mail::raw($request->body, function ($message) use ($request) {
    //         $message->to($request->to)
    //                 ->subject($request->subject);
    //     });

    //     return response()->json(['message' => 'Email sent successfully!']);
    // }

    public function sendLeadEmail(Request $request)
    {
        $lead = Lead::findOrFail($request->lead_id);
        $user = User::findOrFail($request->user_id);

        Mail::to($user->email)->send(new NewLeadMail($lead, $user));

        return response()->json([
            'status' => true,
            'message' => 'Email sent successfully'
        ]);
    }
}


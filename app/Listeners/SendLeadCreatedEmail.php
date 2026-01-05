<?php

namespace App\Listeners;

use App\Events\LeadCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadMail;

class SendLeadCreatedEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LeadCreated  $event
     * @return void
     */
   public function handle(LeadCreated $event)
    {
        $lead = $event->lead;

        if(!$lead->email){
            \Log::error('Lead email missing', ['lead_id' => $lead->id]);
            return;
        }

        Mail::to($lead->email)
            ->send(new NewLeadMail($lead));

        \Log::info('NewLeadMail sent', ['email' => $lead->email]);
    }




}

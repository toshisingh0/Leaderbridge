<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewLeadMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $lead;
    // public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lead)
    {
       $this->lead = $lead;
        // $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Lead Assigned')
            ->view('emails.leads.new-lead');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FollowUpReminderMail extends Mailable
{
    use Queueable, SerializesModels;
     public $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageContent)
    {
       $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Follow-up Reminder')
                    ->view('emails.follow_up_reminder')
                    ->with(['messageContent' => $this->messageContent]);
    }
}

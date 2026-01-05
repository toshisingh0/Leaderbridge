<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public FollowUpReminder $reminder)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SmsService $sms)
    {
        $lead = $this->reminder->lead;
        $message = $this->reminder->message;

        $sent = $sms->send($lead->phone, $message);

        $this->reminder->update([
            'sent_at' => now(),
            'status' => $sent ? 'sent' : 'failed',
        ]);
    }
}

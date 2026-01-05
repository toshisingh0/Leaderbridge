<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FollowUp;

class SendFollowUpEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'followup:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send follow-up reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
     public function handle()
    {
        $followUps = FollowUpModel::where('is_done', 0)
            ->where('follow_up_at', '<=', now())
            ->get();

        foreach ($followUps as $followUp) {
            logger("Reminder: Lead ID {$followUp->lead_id}");
        }
    }
}

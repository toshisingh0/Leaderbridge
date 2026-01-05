<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follow_up_reminders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lead_id')->constrained()->onDelete('cascade');
        $table->enum('reminder_type', ['email','sms','in_app']);
        $table->text('message');
        $table->dateTime('scheduled_at');
        $table->dateTime('sent_at')->nullable();
        $table->enum('status', ['pending','sent','failed'])->default('pending');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_up_reminders');
    }
};

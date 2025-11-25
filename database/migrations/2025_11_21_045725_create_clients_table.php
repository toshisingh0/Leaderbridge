<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('comapny')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable()->index();
            $table->enum('source',['web','import','manual','campaign'])->default('manual');
            $table->text('notes')->nullable();
            $table->json('meta')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}

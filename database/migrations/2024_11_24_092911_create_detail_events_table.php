<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_events', function (Blueprint $table) {
            $table->id();
            $table->char('event_id', 5);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('capacity_participants');
            $table->longText('description_participants');
            $table->integer('capacity_volunteers')->default(0);
            $table->longText('description_volunteers')->nullable();
            $table->boolean('requires_volunteers')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_event');
    }
};

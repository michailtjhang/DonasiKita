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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('event_id')->primary(); // Primary Key
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->date('date');
            $table->string('location', 100);
            $table->integer('capacity')->nullable();
            $table->string('status', 50)->default('upcoming'); // upcoming, ongoing, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

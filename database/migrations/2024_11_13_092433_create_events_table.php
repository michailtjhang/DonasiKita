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
            $table->uuid('id')->primary(); // Primary Key
            $table->char('event_id', 5)->unique(); 
            $table->foreignId('category_id')->index()->constrained(); // FK ke categories
            $table->string('title');
            $table->string('slug');
            $table->longText('description');
            $table->string('organizer');
            $table->string('user_id'); // FK ke users
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

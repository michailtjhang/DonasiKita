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
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('donation_id'); // Primary Key
            $table->string('user_id')->nullable(); // FK ke users
            $table->uuid('event_id'); // FK ke events
            $table->string('email'); // Untuk mencatat email donatur tanpa login
            $table->string('name'); // Nama donatur
            $table->double('amount');
            $table->string('payment_method', 50); // Payment methods (e.g., credit_card, transfer)
            $table->string('status', 50)->default('pending'); // pending, confirmed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};

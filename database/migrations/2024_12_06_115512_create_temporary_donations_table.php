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
        Schema::create('temporary_donations', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->char('temp_id', 5);
            $table->string('user_id')->nullable(); // FK ke users
            $table->char('need_id', 5); // FK ke needs
            $table->string('email'); // Untuk mencatat email donatur tanpa login
            $table->string('name'); // Nama donatur
            $table->double('amount')->nullable();
            $table->string('description_item')->nullable();
            $table->string('bank', 50)->nullable(); // Payment methods (e.g., credit_card, transfer)
            $table->string('status', 50)->default('pending'); // pending, confirmed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_donations');
    }
};

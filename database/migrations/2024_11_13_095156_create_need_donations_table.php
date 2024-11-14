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
        Schema::create('need_donations', function (Blueprint $table) {
            $table->uuid('need_donation_id'); // Primary Key
            $table->uuid('donation_id'); // FK ke donations
            $table->uuid('need_id'); // FK ke needs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('need_donations');
    }
};

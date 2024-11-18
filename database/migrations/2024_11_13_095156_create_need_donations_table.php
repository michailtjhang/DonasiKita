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
            $table->id(); // Primary Key
            $table->char('donation_id', 5); // FK ke donations
            $table->char('need_id', 5); // FK ke needs
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

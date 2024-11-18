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
<<<<<<< HEAD
            $table->uuid('donation_id'); // FK ke donations
            $table->uuid('need_id'); // FK ke needs
=======
            $table->char('donation_id', 5); // FK ke donations
            $table->char('need_id', 5); // FK ke needs
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
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

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
        Schema::create('event_registrations', function (Blueprint $table) {
<<<<<<< HEAD
            $table->uuid('registration_id')->primary(); // Primary Key
=======
            $table->uuid('id')->primary(); // Primary Key
            $table->char('registration_id', 5);
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
            $table->string('user_id'); // FK ke users
            $table->uuid('event_id'); // FK ke events
            $table->string('status', 50)->default('registered'); // registered, attended, canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};

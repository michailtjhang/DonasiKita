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
        Schema::create('contact_messages', function (Blueprint $table) {
<<<<<<< HEAD
            $table->uuid('message_id')->primary(); // Primary Key
=======
            $table->uuid('id')->primary(); // Primary Key
            $table->char('message_id', 5);
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
            $table->string('user_id'); // FK ke users
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};

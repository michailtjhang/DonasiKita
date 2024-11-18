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
<<<<<<< HEAD
            $table->uuid('event_id')->primary(); // Primary Key
=======
            $table->uuid('id')->primary(); // Primary Key
            $table->string('event_id'); 
            $table->foreignId('category_id')->index()->constrained(); // FK ke categories
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
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

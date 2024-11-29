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
        Schema::create('needs', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->char('need_id', 5)->unique();
            $table->string('title');
            $table->string('slug');
            $table->string('towards');
            $table->date('days_left');
            $table->longText('description');
            $table->longText('description_need');
            $table->double('target_amount');
            $table->double('current_amount')->default(0); // Default 0
            $table->string('status', 50)->default('ongoing'); // ongoing, completed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('needs');
    }
};

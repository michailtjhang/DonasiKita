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
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary Key
            $table->char('blog_id', 5)->unique();
            $table->foreignId('category_id')->index()->constrained(); // FK ke categories
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->integer('views');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

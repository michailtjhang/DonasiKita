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
        Schema::create('thumbnails', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->char('blog_id', 5)->nullable(); // FK ke blogs
            $table->char('event_id', 5)->nullable(); // FK ke events
            $table->char('need_id', 5)->nullable(); // FK ke needs
            $table->integer('category_id')->nullable(); // FK ke categories
            $table->string('file_path', 255);
            $table->string('id_file', 255)->nullable();
            $table->string('type', 50); // Image, Video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thumbnails');
    }
};

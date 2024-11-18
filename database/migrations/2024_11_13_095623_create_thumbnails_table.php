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
<<<<<<< HEAD
            $table->uuid('thumbnail_id')->primary(); // Primary Key
            $table->uuid('blog_id'); // FK ke blogs
=======
            $table->id(); // Primary Key
            $table->char('blog_id', 5); // FK ke blogs
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
            $table->string('file_path', 255);
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

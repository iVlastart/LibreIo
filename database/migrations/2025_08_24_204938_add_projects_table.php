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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->json('original_files')->nullable();
            $table->json('audio_files')->nullable();
            $table->json('image_files')->nullable();
            $table->json('timeline_data')->nullable();
            $table->json('effects_data')->nullable();
            $table->string('output_file')->nullable();
            $table->string('resolution')->nullable();
            $table->string('format')->nullable();
            $table->integer('duration')->nullable();
            $table->bigInteger('size')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

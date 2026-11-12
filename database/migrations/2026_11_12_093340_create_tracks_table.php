<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained()->restrictOnDelete();
            $table->string('title', 150)->index();
            $table->text('description')->nullable();
            $table->string('audio_path');
            $table->string('cover_path')->nullable();
            $table->unsignedInteger('duration'); // секунды
            $table->unsignedInteger('plays_count')->default(0)->index();
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending');
            $table->string('reject_reason')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('galleryable_type');
            $table->unsignedBigInteger('galleryable_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('status', 50);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['galleryable_type', 'galleryable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
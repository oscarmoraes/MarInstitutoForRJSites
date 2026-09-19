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
        Schema::create('event_speaks', function (Blueprint $table) {
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('speaker_id')
                ->constrained('speaks')
                ->cascadeOnDelete();

            $table->unsignedInteger('ordem')->default(0);

            $table->timestamps();

            $table->primary(['event_id', 'speaker_id']);

            $table->index(['event_id', 'ordem']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_speaks');
    }
};

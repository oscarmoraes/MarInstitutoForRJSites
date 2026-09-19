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
        Schema::create('event_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->string('nome');
            $table->text('descricao')->nullable();

            $table->decimal('valor', 10, 2)->default(0);

            // Período de validade do preço/lote
            $table->dateTime('inicio')->nullable();
            $table->dateTime('fim')->nullable();

            $table->unsignedInteger('vagas')->nullable();

            $table->boolean('ativo')->default(true);

            $table->unsignedInteger('ordem')->default(0);

            $table->timestamps();

            $table->index(['event_id', 'ativo']);
            $table->index(['inicio', 'fim']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_prices');
    }
};

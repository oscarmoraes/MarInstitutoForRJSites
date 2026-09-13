<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->dateTime('data_evento');
            $table->string('local')->default('Auditório do Instituto MAR — Brasília/DF');
            $table->integer('vagas_totais')->default(30);
            $table->string('formato')->default('Híbrido');
            $table->string('carga_horaria')->default('10 Horas Acadêmicas');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

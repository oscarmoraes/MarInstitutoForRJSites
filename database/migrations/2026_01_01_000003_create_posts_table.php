<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('titulo');
            $table->string('categoria')->default('INSTITUCIONAL');
            $table->text('resumo')->nullable();
            $table->longText('conteudo');
            $table->string('imagem_capa')->nullable();
            $table->string('autor')->default('Assessoria de Imprensa MAR');
            $table->string('tempo_leitura')->default('3 min');
            $table->date('publicado_em');
            $table->boolean('destaque')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

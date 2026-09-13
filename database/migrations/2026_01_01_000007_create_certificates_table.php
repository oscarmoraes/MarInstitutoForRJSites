<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('participante_nome');
            $table->string('oab_uf')->nullable();
            $table->string('evento_titulo');
            $table->string('carga_horaria')->default('10 Horas Acadêmicas');
            $table->date('data_emissao');
            $table->string('hash_digital');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

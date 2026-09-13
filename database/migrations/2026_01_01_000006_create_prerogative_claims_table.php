<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prerogative_claims', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo')->unique();
            $table->string('adv_nome');
            $table->string('adv_oab');
            $table->string('adv_uf');
            $table->string('adv_email');
            $table->string('adv_phone');
            $table->string('tipo_violacao');
            $table->string('orgao_local');
            $table->string('autor_atentado')->nullable();
            $table->string('processo_num')->nullable();
            $table->text('descricao_fatos');
            $table->string('anexo_url')->nullable();
            $table->enum('status', ['RECEBIDO', 'EM_ANALISE', 'ATENDIDO', 'CONCLUIDO'])->default('RECEBIDO');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prerogative_claims');
    }
};

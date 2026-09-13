<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->string('nome');
            $table->string('cpf')->nullable();
            $table->string('email');
            $table->string('oab');
            $table->string('uf');
            $table->string('categoria')->default('Advogado Efetivo');
            $table->string('comissao')->nullable();
            $table->enum('status', ['ATIVO', 'PENDENTE', 'SUSPENSO'])->default('ATIVO');
            $table->date('validade');
            $table->string('foto_url')->nullable();
            $table->string('hash_validacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};

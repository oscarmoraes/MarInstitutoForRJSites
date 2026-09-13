<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cargo');
            $table->string('oab')->nullable();
            $table->string('uf')->nullable();
            $table->enum('tipo', ['DIRETORIA', 'REPRESENTANTE', 'HONORARIO'])->default('DIRETORIA');
            $table->string('foto_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('board_members');
    }
};

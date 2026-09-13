<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('official_documents', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('titulo');
            $table->text('resumo')->nullable();
            $table->date('data_publicacao');
            $table->string('categoria')->default('NOTA_OFICIAL');
            $table->string('arquivo_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('official_documents');
    }
};

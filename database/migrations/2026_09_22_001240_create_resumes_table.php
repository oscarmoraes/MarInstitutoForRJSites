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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();

            // Dados pessoais
            $table->string('nome');
            $table->string('email');
            $table->string('telefone')->nullable();
            $table->string('telefone_contato')->nullable();

            // Localização
            $table->unsignedInteger('state_id')->nullable();
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('no action')
                ->onUpdate('no action');

            // Presença profissional
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('site')->nullable();

            // Perfil profissional
            $table->string('cargo_atual')->nullable();
            $table->string('area_atuacao')->nullable();
            $table->text('areas_interesse')->nullable();
            $table->text('resumo_profissional')->nullable();

            // Mensagem enviada pelo candidato
            $table->text('mensagem')->nullable();

            // Arquivo do currículo
            $table->string('curriculo_arquivo')->nullable();

            // Controle
            $table->string('origem')->default('site');
            $table->string('status')->default('novo');

            // LGPD
            $table->boolean('lgpd_consentimento')->default(false);
            $table->timestamp('lgpd_consentimento_em')->nullable();
            $table->string('politica_privacidade_versao')->nullable();

            $table->timestamps();

            // Índices
            $table->index('email');
            $table->index('status');
            $table->index('origem');
            $table->index('area_atuacao');
            $table->index('state_id');
            $table->index('city_id');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};

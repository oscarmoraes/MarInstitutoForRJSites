<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('subtitulo')->nullable()->after('titulo');
            $table->text('resumo')->nullable()->after('subtitulo');
            $table->string('imagem_capa')->nullable()->after('resumo');

            $table->dateTime('inicio')->nullable()->after('data_evento');
            $table->dateTime('fim')->nullable()->after('inicio');

            $table->string('endereco')->nullable()->after('local');
            $table->unsignedInteger('state_id')->nullable()->after('endereco');
            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->unsignedInteger('city_id')->nullable()->after('state_id');
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->boolean('exige_inscricao')->default(false)->after('formato');
            $table->dateTime('inscricoes_inicio')->nullable()->after('exige_inscricao');
            $table->dateTime('inscricoes_fim')->nullable()->after('inscricoes_inicio');

            $table->boolean('possui_certificado')->default(false)->after('carga_horaria');
            $table->string('carga_horaria_estudante')->nullable()->after('possui_certificado');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropForeign(['city_id']);

            $table->dropColumn([
                'subtitulo',
                'resumo',
                'imagem_capa',
                'inicio',
                'fim',
                'endereco',
                'state_id',
                'city_id',
                'exige_inscricao',
                'inscricoes_inicio',
                'inscricoes_fim',
                'possui_certificado',
                'carga_horaria_estudante',
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Identidade Visual
            $table->string('site_name')->default('Instituto MAR');
            $table->string('site_tagline')->default('Movimento da Advocacia Renovada');
            $table->string('logo_url')->nullable();
            $table->string('favicon_url')->nullable();

            // Contatos e Redes Sociais
            $table->string('email_contato')->default('contato@institutomar.org.br');
            $table->string('telefone_plantao')->default('0800 777 9000');
            $table->string('whatsapp_plantao')->default('(61) 99999-0000');
            $table->string('endereco_sede_df')->default('Setor de Autarquias Sul, Quadra 05, Lote 02 — Brasília / DF');
            $table->string('endereco_sede_sp')->default('Av. Paulista, 1842, 14º andar — Bela Vista — São Paulo / SP');
            $table->string('instagram_url')->nullable()->default('https://www.instagram.com/institutomardireito');
            $table->string('linkedin_url')->nullable()->default('https://www.linkedin.com/company/institutomardireito');
            $table->string('youtube_url')->nullable()->default('https://www.youtube.com/@institutomardireito');
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();

            // Rótulos Editáveis do Menu
            $table->string('menu_inicio')->default('Início');
            $table->string('menu_institucional')->default('Institucional');
            $table->string('menu_diretoria')->default('Diretoria e Comissões');
            $table->string('menu_representantes')->default('Representantes por Estado');
            $table->string('menu_honorarios')->default('Membros Honorários');
            $table->string('menu_conteudo')->default('Conteúdo');
            $table->string('menu_noticias')->default('Notícias e Portal');
            $table->string('menu_atos')->default('Notas e Atos Oficiais');
            $table->string('menu_cursos')->default('Cursos e Palestras');
            $table->string('menu_validar_cert')->default('Validar Certificado');
            $table->string('menu_prerrogativas')->default('Prerrogativas 24h');
            $table->string('menu_contato')->default('Contato');
            $table->string('menu_carteirinha')->default('Carteirinha');
            $table->string('menu_associar')->default('Seja um Associado');

            // Ativação / Desativação de Módulos
            $table->boolean('modulo_noticias')->default(true);
            $table->boolean('modulo_cursos')->default(true);
            $table->boolean('modulo_atos_oficiais')->default(true);
            $table->boolean('modulo_prerrogativas')->default(true);
            $table->boolean('modulo_associacao')->default(true);
            $table->boolean('modulo_carteirinha')->default(true);
            $table->boolean('modulo_certificados')->default(true);
            $table->boolean('modulo_representantes')->default(true);
            $table->boolean('modulo_diretoria')->default(true);
            $table->boolean('modulo_honorarios')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

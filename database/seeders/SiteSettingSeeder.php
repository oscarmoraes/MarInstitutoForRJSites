<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Instituto MAR',
                'site_tagline' => 'Movimento da Advocacia Renovada',
                'logo_url' => 'assets/images/logo-mar.png',
                'favicon_url' => null,

                'email_contato' => 'contato@institutomar.org.br',
                'telefone_plantao' => '0800 777 9000',
                'whatsapp_plantao' => '(61) 99999-0000',
                'endereco_sede_df' => 'Setor de Autarquias Sul, Quadra 05, Lote 02 — Brasília / DF',
                'endereco_sede_sp' => 'Av. Paulista, 1842, 14º andar — Bela Vista — São Paulo / SP',
                'instagram_url' => 'https://www.instagram.com/institutomardireito',
                'linkedin_url' => 'https://www.linkedin.com/company/institutomardireito',
                'youtube_url' => 'https://www.youtube.com/@institutomardireito',
                'twitter_url' => null,
                'facebook_url' => null,

                'menu_inicio' => 'Início',
                'menu_institucional' => 'Institucional',
                'menu_diretoria' => 'Diretoria e Comissões',
                'menu_representantes' => 'Representantes por Estado',
                'menu_honorarios' => 'Membros Honorários',
                'menu_conteudo' => 'Conteúdo',
                'menu_noticias' => 'Notícias e Portal',
                'menu_atos' => 'Notas e Atos Oficiais',
                'menu_cursos' => 'Cursos e Palestras',
                'menu_validar_cert' => 'Validar Certificado',
                'menu_prerrogativas' => 'Prerrogativas 24h',
                'menu_contato' => 'Contato',
                'menu_carteirinha' => 'Carteirinha',
                'menu_associar' => 'Seja um Associado',

                'modulo_noticias' => true,
                'modulo_cursos' => true,
                'modulo_atos_oficiais' => true,
                'modulo_prerrogativas' => true,
                'modulo_associacao' => true,
                'modulo_carteirinha' => true,
                'modulo_certificados' => true,
                'modulo_representantes' => true,
                'modulo_diretoria' => true,
                'modulo_honorarios' => true,
            ]
        );
    }
}

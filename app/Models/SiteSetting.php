<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Identidade
        'site_name',
        'site_tagline',
        'logo_url',
        'favicon_url',

        // Contatos e Redes
        'email_contato',
        'telefone_plantao',
        'whatsapp_plantao',
        'endereco_sede_df',
        'endereco_sede_sp',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'twitter_url',
        'facebook_url',

        // Rótulos de Menu
        'menu_inicio',
        'menu_institucional',
        'menu_diretoria',
        'menu_representantes',
        'menu_honorarios',
        'menu_conteudo',
        'menu_noticias',
        'menu_atos',
        'menu_cursos',
        'menu_validar_cert',
        'menu_prerrogativas',
        'menu_contato',
        'menu_carteirinha',
        'menu_associar',

        // Módulos
        'modulo_noticias',
        'modulo_cursos',
        'modulo_atos_oficiais',
        'modulo_prerrogativas',
        'modulo_associacao',
        'modulo_carteirinha',
        'modulo_certificados',
        'modulo_representantes',
        'modulo_diretoria',
        'modulo_honorarios',
    ];

    protected $casts = [
        'modulo_noticias' => 'boolean',
        'modulo_cursos' => 'boolean',
        'modulo_atos_oficiais' => 'boolean',
        'modulo_prerrogativas' => 'boolean',
        'modulo_associacao' => 'boolean',
        'modulo_carteirinha' => 'boolean',
        'modulo_certificados' => 'boolean',
        'modulo_representantes' => 'boolean',
        'modulo_diretoria' => 'boolean',
        'modulo_honorarios' => 'boolean',
    ];

    public static function getSettings(): self
    {
        return Cache::remember('site_settings_single', 60, function () {
            return static::first() ?? static::create([
                'site_name' => 'Instituto MAR',
                'site_tagline' => 'Movimento da Advocacia Renovada',
                'logo_url' => 'assets/images/logo-mar.png',
                'email_contato' => 'contato@institutomar.org.br',
                'telefone_plantao' => '0800 777 9000',
                'whatsapp_plantao' => '(61) 99999-0000',
                'instagram_url' => 'https://www.instagram.com/institutomardireito',
                'linkedin_url' => 'https://www.linkedin.com/company/institutomardireito',
                'youtube_url' => 'https://www.youtube.com/@institutomardireito',
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
            ]);
        });
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('site_settings_single');
        });

        static::deleted(function () {
            Cache::forget('site_settings_single');
        });
    }
}

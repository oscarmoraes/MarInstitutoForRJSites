<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'titulo',
        'categoria',
        'resumo',
        'conteudo',
        'imagem_capa',
        'autor',
        'tempo_leitura',
        'publicado_em',
        'destaque',
        'img_styles'
    ];

    protected $casts = [
        'publicado_em' => 'date',
        'destaque' => 'boolean',
        'img_styles' => 'array', 
    ];

    public function getImgStyle(string $key, $default = null)
    {
        return $this->img_styles[$key] ?? $default;
    }

    public function getImgStyleFormatted(string $key): string
    {
        if (isset($this->img_styles[$key]) && $this->img_styles[$key] != null) {
            return 'style=' . $this->img_styles[$key] ;
        }
        
        return "";
    }
    
}

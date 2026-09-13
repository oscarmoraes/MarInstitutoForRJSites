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
    ];

    protected $casts = [
        'publicado_em' => 'date',
        'destaque' => 'boolean',
    ];
}

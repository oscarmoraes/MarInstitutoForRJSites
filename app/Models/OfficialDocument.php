<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'titulo',
        'resumo',
        'data_publicacao',
        'categoria',
        'arquivo_url',
    ];

    protected $casts = [
        'data_publicacao' => 'date',
    ];
}

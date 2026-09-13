<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'participante_nome',
        'oab_uf',
        'evento_titulo',
        'carga_horaria',
        'data_emissao',
        'hash_digital',
    ];

    protected $casts = [
        'data_emissao' => 'date',
    ];
}

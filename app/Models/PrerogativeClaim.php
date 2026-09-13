<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrerogativeClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'protocolo',
        'adv_nome',
        'adv_oab',
        'adv_uf',
        'adv_email',
        'adv_phone',
        'tipo_violacao',
        'orgao_local',
        'autor_atentado',
        'processo_num',
        'descricao_fatos',
        'anexo_url',
        'status',
    ];
}

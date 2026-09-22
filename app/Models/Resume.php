<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'telefone_contato',
        'state_id',
        'city_id',
        'linkedin',
        'instagram',
        'site',
        'cargo_atual',
        'area_atuacao',
        'areas_interesse',
        'resumo_profissional',
        'mensagem',
        'curriculo_arquivo',
        'origem',
        'status',
        'lgpd_consentimento',
        'lgpd_consentimento_em',
        'politica_privacidade_versao'
    ];

    protected $casts = [
        'lgpd_consentimento' => 'boolean',
        'lgpd_consentimento_em' => 'datetime',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

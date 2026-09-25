<?php

namespace App\Models;

use App\Observers\MemberObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(MemberObserver::class)]
class Member extends Model
{
    use HasFactory;

    //Representantes e coordenadores regionais do Instituto MAR

    protected $fillable = [
        'matricula',
        'nome',
        'cpf',
        'email',
        'telefone',
        'oab',
        'uf',
        'categoria',
        'comissao',
        'status',
        'validade',
        'foto_url',
        'hash_validacao',
        'state_id',
    ];

    protected $casts = [
        'validade' => 'date',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}

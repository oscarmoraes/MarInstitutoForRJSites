<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cargo',
        'oab',
        'uf',
        'tipo',
        'foto_url',
        'bio',
        'ordem',
        'state_id',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}

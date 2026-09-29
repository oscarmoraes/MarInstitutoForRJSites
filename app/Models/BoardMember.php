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
        'img_styles',
        'state_id',
    ];

    protected $casts = [
        'img_styles' => 'array', 
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

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

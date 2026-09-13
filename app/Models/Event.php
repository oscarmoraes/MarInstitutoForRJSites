<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'titulo',
        'descricao',
        'data_evento',
        'local',
        'vagas_totais',
        'formato',
        'carga_horaria',
        'ativo',
    ];

    protected $casts = [
        'data_evento' => 'datetime',
        'ativo' => 'boolean',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }
}

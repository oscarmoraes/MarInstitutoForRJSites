<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        // Identificação
        'slug',
        'titulo',
        'subtitulo',
        'resumo',
        'descricao',
        'imagem_capa',

        // Data e horário
        'data_evento',
        'inicio',
        'fim',

        // Local
        'formato',
        'local',
        'endereco',
        'state_id',
        'city_id',

        // Inscrições
        'exige_inscricao',
        'inscricoes_inicio',
        'inscricoes_fim',
        'vagas_totais',

        // Capacitação
        'carga_horaria',
        'possui_certificado',
        'carga_horaria_estudante',

        // Controle
        'ativo',
    ];  

    protected $casts = [
        'data_evento' => 'date',
        'inicio' => 'datetime',
        'fim' => 'datetime',

        'inscricoes_inicio' => 'datetime',
        'inscricoes_fim' => 'datetime',

        'exige_inscricao' => 'boolean',
        'possui_certificado' => 'boolean',
        'ativo' => 'boolean',

        // 'carga_horaria' => 'decimal:2',
        // 'carga_horaria_estudante' => 'decimal:2',
    ];

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(EventPrice::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speak::class, 'event_speaks', 'event_id', 'speaker_id')
            ->withPivot('ordem')
            ->orderByPivot('ordem');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class)
            ->orderBy('inicio');
    }

    public function galleries(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'galleryable');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

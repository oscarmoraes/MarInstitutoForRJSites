<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPrice extends Model
{
    use HasFactory;

    protected $table = 'event_prices';

    protected $fillable = [
        'event_id',
        'nome',
        'descricao',
        'valor',
        'inicio',
        'fim',
        'vagas',
        'ativo',
        'ordem',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'inicio' => 'datetime',
        'fim' => 'datetime',
        'vagas' => 'integer',
        'ativo' => 'boolean',
        'ordem' => 'integer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}

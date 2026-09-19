<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSchedule extends Model
{
    use HasFactory;

    protected $table = 'event_schedules';

    protected $fillable = [
        'event_id',
        'speaker_id',
        'titulo',
        'descricao',
        'inicio',
        'fim',
        'ordem',
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fim' => 'datetime',
        'ordem' => 'integer',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(Speak::class);
    }
}

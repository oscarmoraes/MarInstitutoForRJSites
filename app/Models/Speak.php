<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speak extends Model
{
    use HasFactory;

    protected $table = 'speaks';

    protected $fillable = [
        'nome',
        'slug',
        'cargo',
        'foto',
        'mini_bio',
        'biografia',
        'email',
        'linkedin',
        'instagram',
        'site',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_speaks', 'speaker_id', 'event_id')
            ->withPivot('ordem')
            ->orderByPivot('ordem');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(EventSchedule::class);
    }
}

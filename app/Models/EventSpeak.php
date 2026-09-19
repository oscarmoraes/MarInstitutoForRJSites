<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSpeak extends Model
{
    protected $table = 'event_speaks';

    protected $fillable = [
        'event_id',
        'speaker_id',
        'ordem',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speak::class, 'speaker_id');
    }
}

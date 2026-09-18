<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'galleryable_type',
        'galleryable_id',
        'title',
        'slug',
        'description',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function galleryable(): MorphTo
    {
        return $this->morphTo();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(GalleryPhoto::class);
    }
}
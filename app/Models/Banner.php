<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'button_text', 'button_url',
        'media_id', 'sort_order', 'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->media?->url ?? '';
    }

    public function scopePublished($query)
    {
        return $query->where('published', true)->orderBy('sort_order');
    }
}

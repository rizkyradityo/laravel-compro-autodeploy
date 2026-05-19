<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'event_date', 'event_time',
        'location', 'price', 'capacity', 'registration_status',
        'media_id', 'published', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'event_date' => 'date',
        'price' => 'decimal:2',
        'published' => 'boolean',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function getThumbUrlAttribute(): string
    {
        return $this->media?->url ?? '';
    }

    public function getPriceFormattedAttribute(): string
    {
        return $this->price > 0
            ? 'Rp ' . number_format($this->price, 0, ',', '.')
            : 'Gratis';
    }

    public function getExcerptAttribute(): string
    {
        $text = strip_tags($this->content ?? '');
        $text = preg_replace('/\s+/', ' ', trim($text));
        return Str::limit($text, 200);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeOpen($query)
    {
        return $query->where('registration_status', 'open');
    }
}

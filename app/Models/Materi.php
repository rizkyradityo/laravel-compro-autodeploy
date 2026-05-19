<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'title', 'slug', 'description', 'content_type',
        'file_url', 'link_url', 'category', 'media_id', 'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}

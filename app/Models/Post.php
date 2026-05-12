<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'published',
        'user_id',
        'media_id'
    ];

    /**
     * A post belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A post has one media item (cover image).
     */
    public function media()
    {
        return $this->morphOne(Media::class, 'media');
    }

    /**
     * Check if the post is published.
     */
    public function isPublished(): bool
    {
        return $this->published;
    }
}
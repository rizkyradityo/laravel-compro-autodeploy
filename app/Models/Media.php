<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = [
        'original_name',
        'file_path',
        'mime_type',
        'size',
        'mediaable_type',
        'mediaable_id'
    ];

    /**
     * Polymorphic relationship to any model that can have media.
     */
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'mediaable');
    }

    public function contactMessages()
    {
        return $this->morphMany(ContactMessage::class, 'mediaable');
    }

    /**
     * Get the URL for the media file.
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Check if media is an image based on mime type.
     */
    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }
}

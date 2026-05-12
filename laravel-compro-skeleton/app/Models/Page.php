<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'type',
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'published',
        'media_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}

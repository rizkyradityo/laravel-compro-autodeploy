<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
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

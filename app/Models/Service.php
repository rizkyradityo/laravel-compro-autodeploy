<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
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

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
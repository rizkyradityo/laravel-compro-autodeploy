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
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
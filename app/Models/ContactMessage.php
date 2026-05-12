<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'media_id',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}

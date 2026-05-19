<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id', 'name', 'email', 'phone', 'order_id',
        'snap_token', 'payment_status', 'amount', 'proof_image',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopePendingQris($query)
    {
        return $query->where('payment_status', 'pending_qris');
    }
}

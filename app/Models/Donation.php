<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'amount', 'message',
        'order_id', 'snap_token', 'payment_status', 'proof_image',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }
}

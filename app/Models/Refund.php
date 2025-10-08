<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Refund;

class Refund extends Model
{
    protected $table = 'refunds';
    protected $fillable = [
        'payment_id', 'amount', 'provider_refund_id', 'reason'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}

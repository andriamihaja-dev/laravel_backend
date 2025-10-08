<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Refund;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'customer_id', 'amount', 'currency', 'status', 'provider', 'provider_payment_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class, 'payment_id');
    }
}

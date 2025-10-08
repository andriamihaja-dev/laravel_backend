<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Refund;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 'email', 'phone', 'provider', 'provider_customer_id'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'customer_id');
    }
}

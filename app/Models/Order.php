<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'items',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'status',
        'payment_method',
    ];
}

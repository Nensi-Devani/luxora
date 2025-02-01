<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipped_date',
        'delivered_date',
        'is_express_delivery',
        'delivery_charges',
        'payment_mode',
        'payment_status',
        'user_detail_id',
        'tracking_no'
    ];
}

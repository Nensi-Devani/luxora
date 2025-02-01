<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_size_id',
        'product_discount_id',
        'quantity',
        'price',
        'is_gifted',
        'gift_charge'
    ];
}

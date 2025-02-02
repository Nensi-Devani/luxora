<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = [
        'metal_id',
        'category_id',
        'gemstone_id',
        'ocassion_id',
        'name',
        'description',
        'gender',
        'delivery_charge',
        'express_delivery_available',
        'express_delivery_charge',
        'warranty_period',
        'images',
        'certificate',
        'status'
    ];
}

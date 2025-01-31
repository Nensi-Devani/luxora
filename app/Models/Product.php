<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected  $fillable = [
        'metal_id',
        'category_id',
        'gemstone_id',
        'name',
        'description',
        'gender',
        'discount',
        'metal_weight',
        'metal_purity',
        'gemstone_weight',
        'gemstone_purity',
        'no_of_gemstone',
        'express_delivery_available',
        'express_delivery_charge',
        'warranty_period',
        'images',
        'certificate'
    ];
}

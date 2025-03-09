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
        'slug',
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

    protected $casts = [
        'images' => 'array'
    ];

    public function metal()
    {
        return $this->belongsTo(Metal::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function gemstone()
    {
        return $this->belongsTo(Gemstone::class);
    }
    public function occasion()
    {
        return $this->belongsTo(Occasion::class);
    }
}

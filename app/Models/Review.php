<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

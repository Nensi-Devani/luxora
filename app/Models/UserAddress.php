<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'pin',
        'city',
        'state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

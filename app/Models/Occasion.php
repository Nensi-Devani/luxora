<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gemstone extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];
}

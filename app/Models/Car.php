<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
        'address',
        'latitude',
        'longitude',
        'image',
        'owner_id',
        'is_rented',
    ];
}

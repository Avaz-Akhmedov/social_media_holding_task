<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $casts = [
        'ingredients' => 'array'
    ];

    protected $fillable = [
        'name' ,
        'сook_time',
        'difficulty' ,
        'rating' ,
        'ingredients',
        'cousin',
    ];
}

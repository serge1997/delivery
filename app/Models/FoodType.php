<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;

    protected $table = "food_types";
    protected $fillable = [
        'id',
        'name',
        'description',
        'is_active'
    ];
}

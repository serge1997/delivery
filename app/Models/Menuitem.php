<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;

    protected $table = 'menuitems';

    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'description',
        'restaurant_food_type_id',
        'restaurant_category_id',
        'restaurant_promotion_id',
        'is_active'
    ];
}

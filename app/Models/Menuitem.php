<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'description',
        'restaurant_id',
        'restaurant_food_type_id',
        'restaurant_category_id',
        'restaurant_promotion_id',
        'is_active'
    ];
}

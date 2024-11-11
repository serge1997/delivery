<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function restaurant() : BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function restaurantFoodType() : BelongsTo
    {
        return $this->belongsTo(RestaurantFoodType::class, 'restaurant_food_type_id');
    }

    public function restaurantCategory() : BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class,'restaurant_category_id');
    }
}

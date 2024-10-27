<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantFoodType extends Model
{
    use HasFactory;

    protected $table = 'restaurants_food_types';
    protected $fillable = [
        'id',
        'restaurant_id',
        'food_type_id',
        'is_active'
    ];

    public function isActive() : bool
    {
        return $this->is_active = true;
    }

    public function foodType() : BelongsTo
    {
        return $this->belongsTo(FoodType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function restaurantFoodTypes() : HasMany
    {
        return $this->hasMany(RestaurantFoodType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantFoodType extends Model
{
    use HasFactory;

    protected $table = 'restaurant_type';
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
}

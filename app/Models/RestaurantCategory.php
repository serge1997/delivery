<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $table = 'restaurants_categories';

    protected $fillable = [
        'id',
        'restaurant_id',
        'category_id',
        'is_active'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

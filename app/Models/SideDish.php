<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SideDish extends Model
{
    use HasFactory;

    protected $table = 'sides_dishes';

    protected $fillable = [
        'id',
        'name',
        'description',
        'portion_quantity',
        'price',
        'restaurant_id',
        'is_active'
    ];

    public function restaurant() : BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}

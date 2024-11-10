<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

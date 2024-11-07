<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SideDish extends Model
{
    use HasFactory;

    protected $table = 'side_dishes';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'restaurant_id',
        'is_active'
    ];
}

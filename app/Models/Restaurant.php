<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";
    protected $fillable = [
        'id',
        'name',
        'created_by_name',
        'created_by_phone',
        'created_by_email',
        'email',
        'whatsapp',
        'register_number',
        'is_active'
    ];
}

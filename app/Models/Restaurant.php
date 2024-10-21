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
        'password',
        'created_by_name',
        'created_by_phone',
        'created_by_email',
        'email',
        'password',
        'whatsapp',
        'enterprise_register_number',
        'is_active',
        'cover_image',
        'logo',
        'open_hour',
        'close_hour',
        'longitude',
        'latitude'
    ];
}

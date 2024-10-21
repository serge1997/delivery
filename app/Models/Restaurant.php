<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

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
        'phone',
        'enterprise_register_number',
        'is_active',
        'cover_image',
        'logo',
        'open_hour',
        'close_hour',
        'longitude',
        'latitude'
    ];

    public function password() : Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function sideDish() : HasMany
    {
        return $this->hasMany(SideDish::class, 'restaurant_id');
    }
    public function menuitems() : HasMany
    {
        return $this->hasMany(Menuitem::class);
    }
    public function menuitemsSideDishes() : HasManyThrough
    {
        return $this->hasManyThrough(MenuitemSideDish::class, Menuitem::class, 'restaurant_id', 'menuitem_id');
    }
}

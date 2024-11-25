<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class Customer extends Authenticatable
{
    use HasApiTokens,HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'password',
        'address_id',
        'address_complement'
    ] ;


    public function hasAddress(): bool
    {
        return $this->address_id !== null;
    }

    public function password() : Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value)
        );
    }

}

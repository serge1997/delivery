<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasApiTokens,HasFactory;

    protected $table = 'cutomers';

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

}

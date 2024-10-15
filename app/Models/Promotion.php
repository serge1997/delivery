<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = "promotions";
    protected $fillable = [
        'id',
        'name',
        'description',
        'is_active'
    ];

    public function isActive() : bool
    {
        return $this->is_active;
    }

    public function createdAt() : Attribute
    {
        return Attribute::make(
            get: fn($value) => date('d/m/Y H:i:s', strtotime($value))
        );
    }
}

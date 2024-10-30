<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active'
    ];

    public function updatedAt() : Attribute
    {
        return Attribute::make(
            set: fn($value) => $value = null
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $table = "cities";

    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude'
    ];

    public function municipalities() : HasMany
    {
        return $this->hasMany(Municipality::class, 'city_id');
    }

    public function neighorhoods(): BelongsToMany
    {
        return $this->belongsToMany(Neighbourhood::class, 'municipalities', 'city_id', 'municipality_id');
    }
}

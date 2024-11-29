<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipality extends Model
{
    use HasFactory;

    protected $table = "municipalities";
    protected $fillable = [
        'id',
        'name',
        'city_id',
        'longitude',
        'latitude'
    ];

    public function neighborhoods() : HasMany
    {
        return $this->hasMany(Neighbourhood::class, 'municipality_id');
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';
    protected $fillable = [
        'id',
        'street_reference',
        'city_id',
        'municipality_id',
        'neighbourhood_id',
        'longitude',
        'latitude',
        'zip_code',
        'is_street'
    ];

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function municipality() : BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function neighbourhood() : BelongsTo
    {
        return $this->belongsTo(Neighbourhood::class, 'neighbourhood_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighbourhood extends Model
{
    use HasFactory;

    protected $table = "neighbourhoods";
    protected $fillable = [
        'id',
        'name',
        'city_id',
        'municipality_id',
        'is_risked',
        'longitude',
        'latitude'
    ];

    public function municipality() : BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function cityByMunicpality() : BelongsTo
    {
        return $this->municipality->city();
    }

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}

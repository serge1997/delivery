<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighborhood extends Model
{
    use HasFactory;

    protected $table = "neghborhoods";
    protected $fillable = [
        'id',
        'name',
        'municipality_id',
        'is_risked',
        'longitude',
        'latitude'
    ];

    public function municipality() : BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'municipality_id');
    }

    public function city() : BelongsTo
    {
        return $this->municipality->city();
    }
}

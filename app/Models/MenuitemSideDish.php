<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuitemSideDish extends Model
{
    use HasFactory;

    protected $table = 'menuitem_side_dishes';

    protected $fillable = [
        'id',
        'menuitem_id',
        'side_dishe_id'
    ];

    public function menuitem() : BelongsTo
    {
        return $this->belongsTo(Menuitem::class, 'menuitem_id');
    }
    public function sideDishe() : BelongsTo
    {
        return $this->belongsTo(SideDish::class, 'side_dish_id');
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuitemSideDishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'menuitem_id' => $this->menuitem_id,
            'side_dishe_id' => $this->side_dishe_id,
            'side_dish_name' => $this->sideDishe->name,
            'menuitem_name' => $this->menuitem->name,
            'price'         => $this->sideDishe->price . " FCFA"
        ];
    }
}

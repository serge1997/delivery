<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantFoodTypeResource extends JsonResource
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
            'name' => $this->foodType->name,
            'description' => $this->foodType->description,
            "is_active" => $this->is_active,
            "count_menuitems" => $this->menuitems->count(),
            "active_status" => $this->is_active == true ? "Activé" : "Desactivé",
            "created_at" => date('d/m/Y H:i:s', strtotime($this->created_at))
        ];
    }
}

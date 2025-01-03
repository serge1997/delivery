<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantCategoryResource extends JsonResource
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
            'category' => $this->category->name,
            'description' => $this->category->description,
            'image'     => $this->category->image,
            "is_active" => $this->is_active,
            "active_status" => $this->is_active == true ? "Activé" : "Desactivé",
            "created_at" => date('d/m/Y H:i:s', strtotime($this->created_at))
        ];
    }
}

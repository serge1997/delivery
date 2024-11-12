<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuitemUniqueResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price . " FCFA",
            'image' => $this->image,
            'restaurant_food_type_id' => $this->restaurant_food_type_id,
            'restaurant_category_id' => $this->restaurant_category_id,
            'food_type' => $this->when($this->restaurant_food_type_id !== null, fn() => optional($this->restaurantFoodType)->foodType->name ?? null, 'Non informé'),
            'category' => $this->when($this->restaurant_category_id !== null, fn() => optional($this->restaurantCategory)->category->name ?? null, 'Non informé'),
            "is_active" => $this->is_active ? true : false,
            "active_status" => $this->is_active == true ? "Activé" : "Desactivé",
            "created_at" => date('d/m/Y H:i:s', strtotime($this->created_at)),
            'restaurant_id' => $this->restaurant_id,
            'side_dishes' => MenuitemSideDishResource::collection($this->menuitemSideDishes)
        ];
    }
}

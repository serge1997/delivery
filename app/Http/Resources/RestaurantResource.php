<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'created_by_name' => $this->created_by_name,
            'created_by_phone' => $this->created_by_phone,
            'created_by_email' => $this->created_by_email,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'enterprise_register_number' => $this->enterprise_register_number,
            'is_active' => $this->is_active,
            'cover_image' => $this->cover_image,
            'logo' => $this->logo,
            'slug' => str_replace(' ','-', strtolower($this->name)),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'street_reference' => "$this->street_reference - {$this->municipality->name} - {$this->neighbourhood->name}",
            'city' => $this->city,
            'municipality' => $this->municipality,
            'neighbourhood' => $this->neighbourhood,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'zip_code' => $this->zip_code
        ];
    }
}

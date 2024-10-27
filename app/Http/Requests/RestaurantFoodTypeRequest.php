<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantFoodTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'integer'],
            'food_types_id' => ['required', 'array']
        ];
    }

    public function messages(): array
    {
        return [
            'resaturant.id' => 'votre identificateur est obligatoire',
            'food_types_id.required' => 'le type de plat est obligatoire',
            'food_types_id.array' => 'donnés invalide'
        ];
    }

    public function restaurantId() : int
    {
        return $this->restaurant_id;
    }

    public function foodTypesId() : array
    {
        return $this->food_types_id;
    }
}

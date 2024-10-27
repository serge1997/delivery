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
            'restaurant_id' => ['required'],
            'food_type_id' => ['required'],
            'is_active'  => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'resaturant.id' => 'votre identificateur est obligatoire',
            'food_type_id.required' => 'le type de plat est obligatoire'
        ];
    }

    public function restaurantId() : int
    {
        return $this->restaurant_id;
    }

    public function foodTypeId() : int
    {
        return $this->food_tye_id;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantCategoryRequest extends FormRequest
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
            'categories_id' => ['required', 'array']
        ];
    }

    public function messages(): array
    {
        return [
            'resaturant_id.id' => 'votre identificateur est obligatoire',
            'categories_id.required' => 'le type de plat est obligatoire',
            'categories_id.array' => 'donnés invalide'
        ];
    }

    public function categoriesIds() : array
    {
        return $this->categories_id;
    }

    public function restaurantId() : int
    {
        return $this->restaurant_id;
    }
}

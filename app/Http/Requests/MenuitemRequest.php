<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuitemRequest extends FormRequest
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
            'id' => ['nullable'],
            'name' => ['required'],
            'price' => ['required'],
            'restaurant_id' => ['required'],
            'image' => ['required', 'file'],
            'description' => ['required'],
            'restaurant_food_type_id' => ['required'],
            'restaurant_category_id' => ['nullable'],
            'restaurant_promotion_id' => ['nullable'],
            'is_active' => ['boolean']
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'nom est obligatoire',
            'restaurant_id.required' => 'votre indentificateur non informé',
            'description.required' => 'description est obligatoire',
            'price.required' => 'prix est obligatoire',
            'image.required' => 'image est obligatoire',
            'image.file' => 'type de donné invalide',
            'restaurant_food_type_id.required' => 'type de plat est obligatoire'
        ];
    }
}

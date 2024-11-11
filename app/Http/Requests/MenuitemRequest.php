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
        if ($this->isMethod("post")) {
            return [
                'id' => ['nullable'],
                'name' => ['required'],
                'price' => ['required'],
                'restaurant_id' => ['required'],
                'image' => ['required', 'file'],
                'description' => ['required', 'min:10'],
                'restaurant_food_type_id' => ['required'],
                'restaurant_category_id' => ['nullable'],
                'restaurant_promotion_id' => ['nullable'],
                'is_active' => ['boolean'],
                'side_dishes_id' => ['nullable'],
                'menuitem_id' => ['nullable']
            ];
        }
        return [
            'id' => ['required'],
            'name' => ['required'],
            'price' => ['required'],
            'restaurant_id' => ['required'],
            'description' => ['required', 'min:10'],
            'restaurant_food_type_id' => ['required'],
            'restaurant_category_id' => ['nullable'],
            'restaurant_promotion_id' => ['nullable'],
            'is_active' => ['boolean'],
            'side_dishes_id' => ['nullable'],
            'menuitem_id' => ['nullable']
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'nom est obligatoire',
            'restaurant_id.required' => 'votre indentificateur non informé',
            'description.required' => 'description est obligatoire',
            'description.min' => "10 caracteres minimum. restant " . 10 - strlen($this->description) . " caracteres",
            'price.required' => 'prix est obligatoire',
            'image.required' => 'image est obligatoire',
            'image.file' => 'type de donné invalide',
            'restaurant_food_type_id.required' => 'type de plat est obligatoire'
        ];
    }
}

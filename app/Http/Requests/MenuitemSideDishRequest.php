<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuitemSideDishRequest extends FormRequest
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
            'menuitem_id' => ['required'],
            'side_dish_id' => ['required']
        ];
    }

    public function messages() : array
    {
        return [
            'menuitem_id.required' => "l1item du menu est obligatoire",
            'side_dish_id.required' => "l'accompagnement est obligatoire"
        ];
    }

    public function sideDish()
    {
        return $this->side_dish_id;
    }

    public function menuitem()
    {
        return $this->menuitem_id;
    }
}

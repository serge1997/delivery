<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SideDishRequest extends FormRequest
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
        if ($this->isMethod('PUT')){
            return [
                'id' => ['required'],
                'name' => ['required', 'max:40'],
                'description' => ['nullable'],
                'price' => ['nullable', 'integer'],
                'restaurant_id' => ['required'],
                'is_active' => ['nullable']
            ];
        }
        return [
            'name' => ['required', 'max:40'],
            'description' => ['nullable'],
            'price' => ['nullable', 'integer'],
            'restaurant_id',
            'is_active' => ['nullable']
        ];
    }

    public function messages() : array
    {
        return [
            'id.required' => 'indentificateur não informé',
            'name.required' => 'nom est obligatoire',
            'name.max' => 'maximum 40 caractere',
            'price.integer' => 'sulement numero est accepté',
            'restaurant_id' => 'Votre numero ID non informé',
        ];
    }

    public function name() : string
    {
        return $this->name;
    }

    public function description() : ?string
    {
        return $this->description;
    }

    public function price() : ?float
    {
        return $this->price;
    }

    public function restaurantId() : int
    {
        return $this->restaurant_id;
    }

    public function isActive()
    {
        return $this->is_active;
    }
}

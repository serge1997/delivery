<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodTypeRequest extends FormRequest
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
            'name' => ['required', 'max:30'],
            'description' => ['nullable','max:160'],
            'is_active' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'name.max' => '30 caractere permis',
            'description.max' => '160 caractere permis'
        ];
    }

    public function name() : ?string
    {
        return $this->name;
    }
    public function description() : ?string
    {
        return $this->description;
    }
    public function isActive() : bool
    {
        return $this->is_active;
    }
    public function id()
    {
        return $this->id;
    }
}



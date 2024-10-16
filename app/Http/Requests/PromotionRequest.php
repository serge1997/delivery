<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'name' => ['required', 'max:60'],
            'description' => ['required', 'max:160'],
            'is_active' => ['boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'description.required' => 'La descrition est obligatoire',
            'description' => '160 caractere permis',
            'is_active' => 'valeur invalide'
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

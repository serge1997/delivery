<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'image' => ['required', 'file'],
            'description' => ['required', 'max:160']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire',
            'image.required' => "l'image est obligatoire",
            'image.file'    => "fichier invalide",
            'description.required' => 'La descrition est obligatoire',
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
    public function image()
    {
        return $this->image;
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\EmailValidation;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if ($this->isMethod('POST')){
            return [
                'name' => ['required', 'max:60'],
                'phone' => ['required'],
                'email' => ['nullable', new EmailValidation()],
                'password' => ['required'],
            ];
        }
        return [
            'id' => ['required'],
            'name' => ['required', 'max:60'],
            'phone' => ['required'],
            'email' => ['nullable', new EmailValidation()],
            'password' => ['required'],
        ];
    }

    public function messages() : array
    {
        return [
            'id.required' => 'votre identifiant est obligatoire',
            'name.required' => 'nom est obligatoire',
            'name.max' => '60 caractere maximum permis',
            'phone.required' => 'numero telephone obligatoire',
            'password.required' => 'mots de passe obligatoire'
        ];
    }

    public function name() : string
    {
        return $this->name;
    }
    public function phone() : string
    {
        return $this->phone;
    }
    public function email() : ?string
    {
        return $this->email;
    }
    public function password() : string
    {
        return $this->password;
    }
    public function id() : int
    {
        return $this->id;
    }
}

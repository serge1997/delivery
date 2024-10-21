<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'password' => ['required'],
            'created_by_name' => ['required'],
            'created_by_phone' => ['required'],
            'created_by_email' => ['nullable', 'email'],
            'email' => ['nullable', 'email'],
            'phone' => ['required'],
            'enterprise_register_number' => ['nullable'],
            'is_active' => ['nullable'],
            'cover_image' => ['nullable', 'file'],
            'logo' => ['nullable', 'file'],
            'open_hour' => ['nullable'],
            'close_hour' => ['nullable'],
            'longitude' => ['nullable'],
            'latitude'  => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'nom est obligatoire',
            'created_by_name.required' => 'votre nom est obligatoire',
            'created_by_phone.required' => 'votre telephone est obligatoire',
            'whatsapp.required' => 'whatsapp est obligatoire'
        ];
    }

    public function name() : ?string
    {
        return $this->name;
    }
    public function password() : ?string
    {
        return $this->password;
    }
    public function createdByName() : ?string
    {
        return $this->created_by_name;
    }
    public function createdByPhone() : ?string
    {
        return $this->created_by_phone;
    }
    public function createdByEmail() : ?string
    {
        return $this->created_by_email;
    }
    public function email() : ?string
    {
        return $this->email;
    }
    public function logo() : mixed
    {
        return $this->logo;
    }
    public function coverImage() : mixed
    {
        return $this->cover_image;
    }
    public function enterpriseRegisterNumber() : ?string
    {
        return $this->enterprise_register_number;
    }
    public function isActive() : bool
    {
        return $this->is_active;
    }
    public function phone() : string
    {
        return $this->phone;
    }
}

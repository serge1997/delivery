<?php

namespace App\Http\Requests;

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
                'email' => ['nullable'],
                'password' => ['required'],
            ];
        }
        return [
            'id' => ['required'],
            'name' => ['required', 'max:60'],
            'phone' => ['required'],
            'email' => ['nullable'],
            'password' => ['required'],
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

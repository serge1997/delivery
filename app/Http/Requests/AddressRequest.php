<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'street_reference' => ['required'],
            'city_id'  => ['required'],
            'neighbourhood_id' => ['required'],
            'municipality_id' => ['required_if:has_municipality,1'],
            'zip_code' => ['nullable'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'is_street' => ['nullable']
        ];
    }

    public function messages() : array
    {
        return [
            'street_reference.required' => 'la rue ou reference est obligatoire',
            'city_id.required' => 'la ville est obligatoire',
            'neighbourhood_id.required' => 'le quartier est obligatoire',
            'longitude.required' => 'la longitude est obligatoire',
            'latitude.required' => 'la latitude est obligatoire'
        ];
    }
}

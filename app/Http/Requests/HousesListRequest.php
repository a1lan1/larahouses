<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousesListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'price' => 'string|nullable|max:1000000',
            'bedrooms' => 'string|nullable|max:5',
            'bathrooms' => 'string|nullable|max:5',
            'storeys' => 'string|nullable|max:5',
            'garages' => 'string|nullable|max:5',
        ];
    }
}

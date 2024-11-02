<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrdersRequest extends FormRequest
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
            'id' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|int',
            'currency' => 'required|string',
            'address' => 'required|array',
            'address.city' => 'required|string',
            'address.district' => 'required|string',
            'address.street' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'id is required',
            'id.string' => 'id must be a string',
            
            'name.required' => 'name is required',
            'name.string' => 'name must be a string',
            
            'price.required' => 'price is required',
            'price.int' => 'price must be an integer',

            'currency.required' => 'currency is required',
            'currency.string' => 'currency must be a string',

            'address.required' => 'address is required',
            'address.array' => 'address must be an array',

            'address.city.required' => 'city in address is required',
            'address.city.string' => 'city must be a string',

            'address.district.required' => 'district in address is required',
            'address.district.string' => 'district must be a string',

            'address.street.required' => 'street in address is required',
            'address.street.string' => 'street must be a string',
        ];
    }
}

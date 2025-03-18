<?php

namespace App\Http\Requests\Front\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'nullable',
            'city'=>'nullable',
            'street'=>'nullable',
            'house'=>'nullable',
            'apartment'=>'nullable',
            'floor'=>'nullable',
            'entrance'=>'nullable',
            'lat'=>'nullable',
            'lng'=>'nullable',
            'full_address'=>'nullable',
            'address_comment'=>'nullable',
        ];
    }
}

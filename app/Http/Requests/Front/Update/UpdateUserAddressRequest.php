<?php

namespace App\Http\Requests\Front\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->userAddress->user_id == auth()->id();
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

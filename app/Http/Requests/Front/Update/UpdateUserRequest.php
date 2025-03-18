<?php

namespace App\Http\Requests\Front\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
            'city_id'=>'nullable|integer',
            'street'=>'nullable|string',
            'home'=>'nullable|string',
            'apartment'=>'nullable',
            'comment'=>'nullable'
        ];
    }
}

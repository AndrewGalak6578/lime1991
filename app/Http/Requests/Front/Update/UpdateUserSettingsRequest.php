<?php

namespace App\Http\Requests\Front\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
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
            'email'=>'required|unique:users,email,'.auth()->id(),
            'old_password'=>'nullable',
            'new_password'=>'nullable|confirmed'
        ];
    }
}

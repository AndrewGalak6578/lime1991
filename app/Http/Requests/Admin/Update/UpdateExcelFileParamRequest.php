<?php

namespace App\Http\Requests\Admin\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExcelFileParamRequest extends FormRequest
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
            'param'=>'required',
            'column'=>'required',
            'default_amount'=>'nullable',
            'mm_to_cm'=>'nullable',
            'change_value'=>'nullable',
            'skip_new_values'=>'nullable',
            'char_id' => 'nullable',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'mm_to_cm' => ($this->mm_to_cm == 'on') ? true : false,
            'change_value' => ($this->change_value == 'on') ? true : false,
            'skip_new_values' => ($this->skip_new_values == 'on') ? true : false,
        ]);
    }
}

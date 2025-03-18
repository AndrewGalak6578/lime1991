<?php

namespace App\Http\Requests\Admin\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name'=>'required|string',
            'slug'=>'required|unique:brands,slug,'.$this->brand->id,
            'logo'=>'nullable',
            'cover'=>'nullable',
            'description'=>'nullable',
            'description_2'=>'nullable',
            'description_3'=>'nullable',
            'seo_title'=>'nullable',
            'seo_description'=>'nullable',
            'breadcrumb_name'=>'nullable',
            'status'=>'nullable|integer'
        ];
    }
}

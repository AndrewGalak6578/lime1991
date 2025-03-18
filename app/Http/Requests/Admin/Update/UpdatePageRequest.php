<?php

namespace App\Http\Requests\Admin\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'slug'=>'required|unique:pages,slug,'.$this->page->id,
            'description'=>'nullable',
            'description_2'=>'nullable',
            'seo_title'=>'nullable',
            'seo_description'=>'nullable',
            'breadcrumb_name'=>'nullable',
            'view'=>'nullable'
        ];
    }
}

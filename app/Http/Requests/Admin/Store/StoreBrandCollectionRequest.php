<?php

namespace App\Http\Requests\Admin\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandCollectionRequest extends FormRequest
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
            'brand_id'=>'required|integer',
            'seo_title'=>'nullable',
            'seo_description'=>'nullable',
            'breadcrumb_name'=>'nullable',
            'status'=>'nullable|integer'
        ];
    }
}

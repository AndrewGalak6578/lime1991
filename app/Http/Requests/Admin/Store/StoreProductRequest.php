<?php

namespace App\Http\Requests\Admin\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'code'=>'nullable',
            'price'=>'nullable',
            'amount'=>'nullable',
            'description'=>'nullable',
            'brand_id'=>'nullable',
            'collection_id'=>'nullable',
            'categories'=>'nullable',
            'tags'=>'nullable',
            'labels'=>'nullable',
            'cover'=>'nullable',
            'photos'=>'nullable',
            'seo_title'=>'nullable',
            'seo_description'=>'nullable',
            'breadcrumb_name'=>'nullable',
            'status'=>'nullable|integer',
            'product_type'=>'nullable'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_type'=>(isset($this->product_type) AND $this->product_type == 'on') ? 1 : 0,
        ]);
    }
}

<?php

namespace App\Http\Requests\Admin\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'code'=>'required|unique:coupons,code,'.$this->coupon->id,
            'type'=>'required|integer',
            'coupon_amount'=>'required',
            'users_amount'=>'required|integer',
            'user_id'=>'nullable|integer',
            'available_until'=>'nullable',
            'status'=>'integer'
        ];
    }
}

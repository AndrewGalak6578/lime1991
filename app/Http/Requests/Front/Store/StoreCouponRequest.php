<?php

namespace App\Http\Requests\Front\Store;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCouponRequest extends FormRequest
{
    public $coupon;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', Rule::exists('coupons', 'code')->where('status', 1),],
            'coupon_id' => [Rule::unique('user_coupons')->where('user_id', auth()->id()),],
            'available_until' => 'nullable|date|after:now',
            'active' => 'accepted',
        ];
    }

    protected function prepareForValidation()
    {
        $this->coupon = Coupon::where('code', $this->get('code'))->first();

        $couponUserId = $this->coupon?->user_id;

        $this->merge([
            'coupon_id' => $this->coupon?->id,
            'available_until' => $this->coupon?->available_until,
            'coupon_user_id' => $this->coupon?->user_id,
            'active' => ($couponUserId == 0 || $couponUserId == auth()->id()) ? true : false,
        ]);
    }
}

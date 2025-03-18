<?php

namespace App\Http\Requests\Front\Store;

use App\Rules\CheckAuthEmailOnCheckout;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'delivery_method'=>'required',
            'user_address_id'=>'nullable',
            'full_address'=>'nullable',
            'lat'=>'nullable',
            'lng'=>'nullable',
            'address_comment'=>'nullable',
//            'delivery_price'=>'',
            'last_name'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'email'=>['required', 'email', new CheckAuthEmailOnCheckout()],
//            'amount'=>'',
            'payment_method'=>'required',
//            'status'=>'',
        ];
    }
}

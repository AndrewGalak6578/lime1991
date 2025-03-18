<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        if(getCartCountTotal() == 0){
            return redirect('/');
        }

        if(Auth()->check()){
            $carts = auth()->user()->carts()->get();
        }else {
            $carts = \Cart::getContent();
        }
        $coupon = getActiveCoupon();
        return view('front.checkout.index', [
            'carts'=>$carts,
            'coupon' => $coupon,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Store\StoreCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        $validData = $request->validated();

        $coupon = $request->coupon;
        $user = auth()->user();

        if ($user) {
            $user->coupons()->update([
                'user_coupons.status' => 0,
            ]);
            $user->coupons()->attach($coupon->id, ['status' => 1]);
        } else{
            Session::put('coupon', $coupon->id);
        }
        flash()->success('Промо код успешно активирован');
        return back();
    }
}

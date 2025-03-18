<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCouponRequest;
use App\Http\Requests\Admin\Update\UpdateCouponRequest;
use App\Models\Brand;
use App\Models\CouponBrand;
use App\Models\Coupon;
use App\Models\User;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.coupons.index', [
           'coupons'=>Coupon::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create', [
            'users'=>User::select(['id', 'name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {
        Coupon::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', [
            'coupon'=>$coupon,
            'users'=>User::select(['id', 'name'])->get(),
            'brands'=>Brand::all(),
            'couponBrands'=>$coupon->brands()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->brands()->delete();
        $coupon->delete();
        flash('Удалено!')->error();
        return back();
    }
}

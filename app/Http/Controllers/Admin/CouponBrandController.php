<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCouponBrandRequest;
use App\Http\Requests\Admin\Update\UpdateCouponBrandRequest;
use App\Models\CouponBrand;

class CouponBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponBrandRequest $request)
    {
        CouponBrand::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CouponBrand $couponBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CouponBrand $couponBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponBrandRequest $request, CouponBrand $couponBrand)
    {
        $couponBrand->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CouponBrand $couponBrand)
    {
        $couponBrand->delete();
        flash('Удалено!')->error();
        return back();
    }
}

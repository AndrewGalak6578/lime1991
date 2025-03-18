<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StorePromotionRequest;
use App\Http\Requests\Admin\Update\UpdatePromotionRequest;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::all();

        return view('admin.promotion.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::latest()->pluck('name', 'id');

        return view('admin.promotion.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromotionRequest $request)
    {
        $validData = $request->validated();

        $promotion = Promotion::create($validData);
        Product::query()->whereIn('id', $validData['product_ids'])->update(['promotion_id' => $promotion->id]);

        if ($request->hasFile('img')) {
            $promotion->addMediaFromRequest('img')->toMediaCollection('cover');
        }
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        $products = Product::latest()->pluck('name', 'id');
        $promotionProducts = $promotion->products;

        return view('admin.promotion.edit', compact('products', 'promotion', 'promotionProducts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        $validData = $request->validated();

        $promotion->products()->update(['promotion_id' => null]);
        Product::query()->whereIn('id', $validData['product_ids'])->update(['promotion_id' => $promotion->id]);
        $promotion->update($validData);
        if ($request->hasFile('img')) {
            $promotion->addMediaFromRequest('img')->toMediaCollection('cover');
        }
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->products()->update(['promotion_id' => null]);
        $promotion->delete();
        flash('Удалено!')->error();
        return back();
    }
}

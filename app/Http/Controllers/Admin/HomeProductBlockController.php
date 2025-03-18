<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeProductBlockRequest;
use App\Http\Requests\UpdateHomeProductBlockRequest;
use App\Models\HomeProductBlock;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeProductBlockController extends Controller
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
    public function store(Request $request)
    {
        $block = HomeProductBlock::find($request->block_id);
        $block->products()->attach($request->product_id);
        flash('Добавлено!')->success();
        return back();
    }

    public function detachProduct(Product $product)
    {
        $product->blocks()->detach();
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeProductBlock $homeProductBlock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeProductBlock $homeProductBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeProductBlockRequest $request, HomeProductBlock $homeProductBlock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeProductBlock $homeProductBlock)
    {
        //
    }
}

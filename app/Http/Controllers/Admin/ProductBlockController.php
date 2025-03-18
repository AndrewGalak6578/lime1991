<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Store\StoreProductBlockRequest;
use App\Http\Requests\Admin\Update\UpdateProductBlockRequest;
use App\Models\ProductBlock;
use App\Http\Controllers\Controller;

class ProductBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.blocks.index', [
            'productBlocks'=>ProductBlock::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.blocks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductBlockRequest $request)
    {
        ProductBlock::create($request->validated());
        flash("Добавлено!")->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductBlock $productBlock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductBlock $productBlock)
    {
        return view('admin.products.blocks.edit', [
            'productBlock'=>$productBlock
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductBlockRequest $request, ProductBlock $productBlock)
    {
        $productBlock->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductBlock $productBlock)
    {
        $productBlock->delete();
        flash('Удалено!')->error();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductTagDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreProductTagRequest;
use App\Http\Requests\Admin\Update\UpdateProductTagRequest;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use function Termwind\render;

class ProductTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductTagDataTable $dataTable)
    {
        return $dataTable->render('admin.products.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.tags.create', [
            'productCategories'=>ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductTagRequest $request)
    {
        ProductTag::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductTag $productTag)
    {
        return view('admin.products.tags.edit', [
            'productTag'=>$productTag,
            'productCategories'=>ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductTagRequest $request, ProductTag $productTag)
    {
        $productTag->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductTag $productTag)
    {
        $productTag->delete();
        flash('Добавлено!')->error();
        return back();
    }
}

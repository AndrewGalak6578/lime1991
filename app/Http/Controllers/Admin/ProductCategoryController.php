<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreProductCategoryRequest;
use App\Http\Requests\Admin\Update\UpdateProductCategoryRequest;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductCategoryDataTable $dataTable)
    {
//        return $dataTable->render('admin.products.categories.index');
        return view('admin.products.categories.index', [
            'productCategories'=>ProductCategory::where('parent_id', 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.categories.create', [
            'productCategories'=>ProductCategory::where('parent_id', 0)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $info = $request->validated();

        ProductCategory::create($info);

        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.products.categories.edit', [
            'productCategory'=>$productCategory,
            'productCategories'=>ProductCategory::where('parent_id', 0)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        flash('Удалено!')->error();
        return back();
    }


}

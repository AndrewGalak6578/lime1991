<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreBrandRequest;
use App\Http\Requests\Admin\Update\UpdateBrandRequest;
use App\Models\Brand;

class BrandCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.products.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $brand->load('collections.products');

        return view('admin.products.brands.edit', [
            'brand'=>$brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->collections()->delete();
        $brand->delete();
        flash('Удалено!')->error();
        return back();
    }
}

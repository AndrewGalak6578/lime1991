<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCharRequest;
use App\Http\Requests\Admin\Update\UpdateCharRequest;
use App\Models\Char;
use App\Models\CharGroup;
use App\Models\ProductCategory;

class CharController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->has('category_id')){
            return view('admin.products.chars.chars.index', [
                'categories'=>ProductCategory::where('parent_id', 0)->get(),
                'charGroups'=>CharGroup::all(),
                'chars'=>ProductCategory::find(request()->get('category_id'))->chars()->get()
            ]);
        }

        return view('admin.products.chars.chars.index', [
//            'chars'=>Char::all()
            'productCategories'=>ProductCategory::where('parent_id', 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.chars.chars.create', [
            'categories'=>ProductCategory::all(),
            'charGroups'=>CharGroup::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharRequest $request)
    {
        Char::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Char $char)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Char $char)
    {
        return view('admin.products.chars.chars.edit', [
            'char'=>$char,
            'categories'=>ProductCategory::all(),
            'charGroups'=>CharGroup::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharRequest $request, Char $char)
    {
        $char->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Char $char)
    {
        $char->delete();
        flash('Удалено!')->error();
        return back();
    }
}

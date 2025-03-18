<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreActionBrandRequest;
use App\Http\Requests\Admin\Update\UpdateActionBrandRequest;
use App\Models\ActionBrand;

class ActionBrandController extends Controller
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
    public function store(StoreActionBrandRequest $request)
    {
        ActionBrand::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ActionBrand $actionBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActionBrand $actionBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActionBrandRequest $request, ActionBrand $actionBrand)
    {
        $actionBrand->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActionBrand $actionBrand)
    {
        $actionBrand->delete();
        flash('Удалено!')->error();
        return back();
    }
}

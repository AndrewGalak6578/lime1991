<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreActionRequest;
use App\Http\Requests\Admin\Update\UpdateActionRequest;
use App\Models\Action;
use App\Models\ActionBrand;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.actions.index',[
            'actions'=>Action::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.actions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActionRequest $request)
    {
        Action::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        return view('admin.actions.edit', [
            'action'=>$action,
            'brands'=>Brand::all(),
            'actionBrands'=>$action->brands()->get(),
            'actionProducts'=>$action->products()->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActionRequest $request, Action $action)
    {
        $action->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action)
    {
        $action->brands()->delete();
        $action->products()->detach();
        $action->delete();
        flash('Удалено!')->error();
        return back();
    }

    public function attachProduct(Request $request){

        $action = Action::find($request['action_id']);
        $action->products()->attach($request['product_id']);

        flash('Добавлено!')->success();
        return back();
    }

    public function removeActionProduct(Request $request){

        $action = Action::find($request['action_id']);
        $action->products()->detach($request['product_id']);

        flash('Отвязано!')->error();
        return back();
    }
}



<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCharGroupRequest;
use App\Http\Requests\Admin\Update\UpdateCharGroupRequest;
use App\Models\CharGroup;

class CharGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.chars.groups.index', [
            'charGroups'=>CharGroup::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.chars.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCharGroupRequest $request)
    {
        CharGroup::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CharGroup $charGroup)
    {
        return view('admin.products.chars.groups.edit', [
            'charGroup'=>$charGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharGroupRequest $request, CharGroup $charGroup)
    {
        $charGroup->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CharGroup $charGroup)
    {
        $charGroup->delete();
        flash('Удалено!')->error();
        return back();
    }
}

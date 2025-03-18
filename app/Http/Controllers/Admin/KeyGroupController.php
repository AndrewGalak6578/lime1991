<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreKeyGroupRequest;
use App\Http\Requests\Admin\Update\UpdateKeyGroupRequest;
use App\Models\KeyGroup;

class KeyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.keys.groups.index', [
            'keyGroups'=>KeyGroup::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.keys.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeyGroupRequest $request)
    {
        KeyGroup::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KeyGroup $keyGroup)
    {
        return view('admin.settings.keys.groups.edit', [
            'keyGroup'=>$keyGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeyGroupRequest $request, KeyGroup $keyGroup)
    {
        $keyGroup->update($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KeyGroup $keyGroup)
    {
        $keyGroup->keys()->delete();
        $keyGroup->delete();
        flash('Удалено!')->error();
        return back();
    }
}

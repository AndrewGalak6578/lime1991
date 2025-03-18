<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreKeyRequest;
use App\Http\Requests\Admin\Update\UpdateKeyRequest;
use App\Models\Key;
use App\Models\KeyGroup;

class KeyController extends Controller
{
    public function keyAndValues()
    {
        return view('admin.settings.keys.index', [
            'keyGroups'=>KeyGroup::all()
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.keys.keys.index', [
            'keys'=>Key::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.keys.keys.create', [
            'keyGroups'=>KeyGroup::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKeyRequest $request)
    {
        Key::create($request->validated());
        flash('Добавелно!')->success();
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Key $key)
    {
        return view('admin.settings.keys.keys.edit', [
            'keyGroups'=>KeyGroup::all(),
            'key'=>$key
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeyRequest $request, Key $key)
    {
        $key->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Key $key)
    {
        $key->delete();
        flash('Удалено!')->error();
        return back();
    }
}

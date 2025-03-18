<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCharValueRequest;
use App\Http\Requests\Admin\Update\UpdateCharValueRequest;
use App\Models\CharValue;

class CharValueController extends Controller
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
    public function store(StoreCharValueRequest $request)
    {
        CharValue::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CharValue $charValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CharValue $charValue)
    {
        return view('admin.products.chars.values.edit', [
            'charValue'=>$charValue,
            'char'=>$charValue->char
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharValueRequest $request, CharValue $charValue)
    {
        $charValue->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CharValue $charValue)
    {
        $charValue->delete();
        flash('Удалено!')->error();
        return back();
    }
}

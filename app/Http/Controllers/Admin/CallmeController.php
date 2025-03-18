<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CallmeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreCallmeRequest;
use App\Http\Requests\Admin\Update\UpdateCallmeRequest;
use App\Models\Callme;

class CallmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CallmeDataTable $dataTable)
    {
        return $dataTable->render('admin.callmes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.callmes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallmeRequest $request)
    {
        Callme::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Callme $callme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Callme $callme)
    {
        return view('admin.callmes.edit', [
            'callme'=>$callme
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCallmeRequest $request, Callme $callme)
    {
        $callme->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Callme $callme)
    {
        $callme->delete();
        flash('Удалено!')->error();
        return back();
    }
}

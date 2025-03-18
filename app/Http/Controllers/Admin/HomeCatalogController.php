<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreHomeCatalogRequest;
use App\Http\Requests\Admin\Update\UpdateHomeCatalogRequest;
use App\Models\HomeCatalog;

class HomeCatalogController extends Controller
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
        return view('admin.pages.homeCatalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeCatalogRequest $request)
    {
        HomeCatalog::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeCatalog $homeCatalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeCatalog $homeCatalog)
    {
        return view('admin.pages.homeCatalog.edit', [
            'homeCatalog'=>$homeCatalog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeCatalogRequest $request, HomeCatalog $homeCatalog)
    {
        $homeCatalog->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeCatalog $homeCatalog)
    {
        $homeCatalog->delete();
        flash('Удалено!')->error();
        return back();
    }
}

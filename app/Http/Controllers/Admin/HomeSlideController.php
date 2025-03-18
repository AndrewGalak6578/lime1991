<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreHomeSlideRequest;
use App\Http\Requests\Admin\Update\UpdateHomeSlideRequest;
use App\Models\HomeSlide;

class HomeSlideController extends Controller
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
        return view('admin.pages.homeSlides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeSlideRequest $request)
    {
        HomeSlide::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeSlide $homeSlide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeSlide $homeSlide)
    {
        return view('admin.pages.homeSlides.edit', [
            'homeSlide'=>$homeSlide
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeSlideRequest $request, HomeSlide $homeSlide)
    {
        $homeSlide->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeSlide $homeSlide)
    {
        $homeSlide->delete();
        flash('Удалено!')->error();
        return back();
    }
}

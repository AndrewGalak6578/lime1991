<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StorePageRequest;
use App\Http\Requests\Admin\Update\UpdatePageRequest;
use App\Models\HomeCatalog;
use App\Models\HomeProductBlock;
use App\Models\HomeSlide;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.index', [
            'pages'=>Page::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request)
    {
        Page::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', [
            'page'=>$page,
            'homeSlides'=>HomeSlide::all(),
            'homeCatalogs'=>HomeCatalog::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $page->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if($page->type != 1){
            $page->keyValues()->delete();
            $page->delete();
            flash('Удалено!')->error();
        }else{
            flash('Страницу удалить нельзя!')->error();
        }
        return back();
    }

    public function homeProducts()
    {
        return view('admin.pages.homeProducts', [
            'blocks'=>HomeProductBlock::all()
        ]);
    }
}

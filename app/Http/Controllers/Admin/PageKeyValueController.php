<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StorePageKeyValueRequest;
use App\Http\Requests\Admin\Update\UpdatePageKeyValueRequest;
use App\Models\Page;
use App\Models\PageKeyValue;

class PageKeyValueController extends Controller
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
        return view('admin.pages.pageKeyValues.create', [
            'page'=>Page::find(request()->get('page_id'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageKeyValueRequest $request)
    {
        $info = $request->validated();

        if($request->type == 0){
             $info['value'] = $request->get('value_input');
        }elseif($request->type == 1){
             $info['value'] = $request->get('value_textarea');
        }elseif($request->type == 2){
            $info['value'] = $request->get('value_editor');
        }elseif($request->type == 3){
            $info['value'] = $request->get('value_image');
        }

        PageKeyValue::create($info);
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PageKeyValue $pageKeyValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageKeyValue $pageKeyValue)
    {
        $page = Page::find($pageKeyValue->page_id);
        return view('admin.pages.pageKeyValues.edit', [
            'page'=>$page,
            'pageKeyValue' => $pageKeyValue
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageKeyValueRequest $request, PageKeyValue $pageKeyValue)
    {
        $pageKeyValue->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageKeyValue $pageKeyValue)
    {
        $pageKeyValue->delete();
        flash('Удалено!')->error();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreExcelFileParamRequest;
use App\Http\Requests\Admin\Update\UpdateExcelFileParamRequest;
use App\Models\ExcelFileParam;

class ExcelFileParamController extends Controller
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
    public function store(StoreExcelFileParamRequest $request)
    {
        ExcelFileParam::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ExcelFileParam $excelFileParam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExcelFileParam $excelFileParam)
    {
        return view('admin.products.imports.files.editParam', [
            'excelFileParam'=>$excelFileParam
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcelFileParamRequest $request, ExcelFileParam $excelFileParam)
    {
//        dd($request->validated());
        $excelFileParam->update($request->validated());
        flash('Обновлено!')->success();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExcelFileParam $excelFileParam)
    {
        $excelFileParam->charSettings()->delete();
        $excelFileParam->delete();
        flash('Удалено!')->error();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreExcelFileNameRequest;
use App\Http\Requests\Admin\Update\UpdateExcelFileNameRequest;
use App\Models\ExcelFileName;

class ExcelFileNameController extends Controller
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
    public function store(StoreExcelFileNameRequest $request)
    {
        ExcelFileName::create($request->validated());
        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ExcelFileName $excelFileName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExcelFileName $excelFileName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcelFileNameRequest $request, ExcelFileName $excelFileName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExcelFileName $excelFileName)
    {
        $excelFileName->delete();
        flash('Удалено!')->error();
        return back();
    }
}

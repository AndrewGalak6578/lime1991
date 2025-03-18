<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreExcelFileParamSettingRequest;
use App\Http\Requests\Admin\Update\UpdateExcelFileParamSettingRequest;
use App\Models\ExcelFileParamSetting;
use Illuminate\Http\Request;

class ExcelFileParamSettingController extends Controller
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
    public function store(StoreExcelFileParamSettingRequest $request)
    {
        $validData = $request->validated();

        ExcelFileParamSetting::create($validData);
        flash('Добавлено')->success();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcelFileParamSettingRequest $request, ExcelFileParamSetting $excelFileParamsSetting)
    {
        $validData = $request->validated();
        $excelFileParamsSetting->update($validData);

        flash('Обновлено')->success();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExcelFileParamSetting $excelFileParamsSetting)
    {
        $excelFileParamsSetting->delete();
        flash('Удалено!')->error();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreExcelFileRequest;
use App\Http\Requests\Admin\Update\UpdateExcelFileRequest;
use App\Imports\Admin\Products\CharImport;
use App\Imports\ExcelFileImport;
use App\Models\ExcelFile;
use Illuminate\Http\Request;

use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;

class ExcelFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.imports.files.index', [
            'excelFiles'=>ExcelFile::all()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExcelFileRequest $request)
    {

//        Excel::load($request['file'], function($reader) {
//
//            // Getting all results
//            $results = $reader->get();
//
//            // ->all() is a wrapper for ->get() and will work the same
//            $results = $reader->first();
//
//            dd($results);
//
//        });
//        $excel = Excel::toA
        $headings = (new HeadingRowImport)->toArray($request['file']);
//        dd($headings);
        $data = $request->validated();
        $data['columns'] = $headings[$request['page']-1];
        ExcelFile::create($data);

        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ExcelFile $excelFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExcelFile $excelFile)
    {
        return view('admin.products.imports.files.edit', [
            'excelFile'=>$excelFile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcelFileRequest $request, ExcelFile $excelFile)
    {
        $excelFile->update($request->validated());
        flash('Обновлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExcelFile $excelFile)
    {
        foreach($excelFile->params()->get() as $param){
            $param->charSettings()->delete();
            $param->delete();
        }

        $excelFile->names()->delete();
        $excelFile->delete();

        flash('Удалено!')->error();
        return back();
    }

    public function importFile(Request $request)
    {
        Excel::queueImport(new ExcelFileImport($request['excel_file_id']), $request->file('file'));
//        Excel::queueImport(new ExcelFileImport($request['excel_file_id']),  $request->file('file'), null, \Maatwebsite\Excel\Excel::XLS, ['sheetIndex' => 3]);

        flash('Добавлено в очередь!')->success();
        return back();
    }
}

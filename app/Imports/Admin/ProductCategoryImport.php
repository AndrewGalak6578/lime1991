<?php

namespace App\Imports\Admin;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductCategoryImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $productCategory = ProductCategory::find($row[0]);
        $info = \Validator::make($row, [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required|unique:product_categories,slug,'.$row[0],
            '3' => 'nullable',
            '4' => 'nullable',
            '5' => 'nullable',
            '6' => 'nullable'
        ])->validate();
        $productCategory->update([
            'name'=>$row[1],
            'slug'=>$row[2],
            'parent_id'=>$row[3],
            'seo_title'=>$row[4],
            'seo_description'=>$row[5],
            'breadcrumb_name'=>$row[6],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}

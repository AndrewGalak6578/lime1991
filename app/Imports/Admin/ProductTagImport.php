<?php

namespace App\Imports\Admin;

use App\Models\ProductTag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductTagImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $productTag = ProductTag::find($row[0]);
        $info = \Validator::make($row, [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required|unique:product_tags,slug,'.$row[0],
            '3' => 'required|integer',
            '4' => 'nullable',
            '5' => 'nullable',
            '6' => 'nullable'
        ])->validate();
        $productTag->update([
            'name'=>$row[1],
            'slug'=>$row[2],
            'product_category_id'=>$row[3],
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

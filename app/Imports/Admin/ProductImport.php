<?php

namespace App\Imports\Admin;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::find($row[0]);
        $info = \Validator::make($row, [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required|unique:products,slug,'.$row[0],
            '3' => 'nullable',
            '4' => 'nullable',
            '5' => 'nullable',
            '6' => 'nullable',
            '7' => 'nullable',
            '8' => 'nullable',
            '9' => 'nullable',
        ])->validate();
        $product->update([
            'name'=>$row[1],
            'slug'=>$row[2],
            'code'=>$row[3],
            'amount'=>$row[4],
            'price'=>$row[5],
            'brand_id'=>$row[6],
            'seo_title'=>$row[7],
            'seo_description'=>$row[8],
            'breadcrumb_name'=>$row[9],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}

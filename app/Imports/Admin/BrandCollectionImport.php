<?php

namespace App\Imports\Admin;

use App\Models\BrandCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BrandCollectionImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $brandCollection = BrandCollection::find($row[0]);
        $info = \Validator::make($row, [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required|unique:brand_collections,slug,'.$row[0],
            '3' => 'nullable',
            '4' => 'nullable',
            '5' => 'nullable',
            '6' => 'nullable',
            '7' => 'nullable',
        ])->validate();
        $brandCollection->update([
            'name'=>$row[1],
            'slug'=>$row[2],
            'brand_id'=>$row[3],
            'seo_title'=>$row[5],
            'seo_description'=>$row[6],
            'breadcrumb_name'=>$row[7],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}

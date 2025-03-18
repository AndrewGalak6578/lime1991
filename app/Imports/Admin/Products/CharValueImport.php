<?php

namespace App\Imports\Admin\Products;

use App\Models\Char;
use App\Models\CharValue;
use App\Models\ProductCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CharValueImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        if($row[2] != null){
            $category = ProductCategory::where('name', $row[0])->first();
            $sub_category = ProductCategory::where([
                'name' => $row[1],
                'parent_id'=>$category->id
            ])->first();
            $char = Char::where([
                'name'=>$row[2],
                'category_id'=>$sub_category->id
            ])->first();
            if($row[3] != null){
                CharValue::firstOrCreate([
                    'value'=>$row[3],
                    'char_id'=>$char->id
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}

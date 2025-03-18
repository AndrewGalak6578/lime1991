<?php

namespace App\Imports\Admin\Products;

use App\Models\Char;
use App\Models\ProductCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;


class CharImport implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
//        dd($row);
        if($row[2] != null)
        {
            $category = ProductCategory::where('name', $row[0])->first();
            $sub_category = ProductCategory::where([
                'name' => $row[1],
                'parent_id'=>$category->id
            ])->first();

            $char = Char::firstOrCreate([
                'name'=>$row[2],
                'category_id'=>$sub_category->id,
                'type'=>($row[4] != null) ? ($row[4] == 'ползунок') ? 1 : 0 : 0
            ]);
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

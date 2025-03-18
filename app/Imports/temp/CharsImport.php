<?php

namespace App\Imports\temp;

use App\Models\Char;
use App\Models\ProductCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class CharsImport implements ToModel
{
    /**
    * @param  array $row
    */
    public function model(array $row)
    {
//        if(!ProductCategory::where('name', $row[0])->exists()){
//            dd($row);
//        }
//        if($row[1] != null){
            Char::create([
                'name'=>$row['1'],
                'category_id'=>ProductCategory::where('name', $row[0])->first()->id,
                'char_group_id'=>($row[2] == 1) ? 1 : 0
            ]);
//        }

    }
}

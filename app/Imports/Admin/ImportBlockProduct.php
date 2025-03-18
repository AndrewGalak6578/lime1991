<?php

namespace App\Imports\Admin;

use App\Models\Product;
use App\Models\ProductBlock;
use App\Models\BlockProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ImportBlockProduct implements ToModel, WithStartRow, WithChunkReading, ShouldQueue
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $name = $row[0];
        $block_name = $row[2];
//        $block_product_name = $row[3];
        $block_product_code = $row[6];

        $product = Product::where('name', $name)->first();
        $blockProduct = Product::where('code', $block_product_code)->first();

        $block = ProductBlock::where('name', $block_name)->first();

        if(BlockProduct::where([
            'product_id'=>$product->id,
            'related_product_id'=>$blockProduct->id,
            'product_block_id'=>$block->id
        ])->doesntExist()){
            $blockProduct = BlockProduct::create([
                'product_id'=>$product->id,
                'related_product_id'=>$blockProduct->id,
                'product_block_id'=>$block->id
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

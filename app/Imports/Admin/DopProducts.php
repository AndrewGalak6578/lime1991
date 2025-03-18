<?php

namespace App\Imports\Admin;

use App\Models\BlockProduct;
use App\Models\Product;
use App\Models\ProductBlock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;


class DopProducts implements ToCollection, WithHeadingRow, WithChunkReading
    , ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $product = Product::where('code',  $row['artikul'] ??  '')->first();

            if (!$product) continue;
            $relations = explode(';', $row['dop_tovary'] ?? '');

            foreach ($relations as $item){

                $productR = Product::where('code', $item)->first();

                if (!$productR) continue;
                BlockProduct::create([
                    'product_block_id' => 0,
                    'product_id' => $product->id,
                    'related_product_id' => $productR->id
                ]);
            };
        }

    }

    public function chunkSize(): int
    {
        return 500;
    }
}

<?php

namespace App\Imports\Admin\Category;

use App\Models\Brand;
use App\Models\BrandCollection;
use App\Models\Char;
use App\Models\CharValue;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Http\Client\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class BlockProductsImport implements ToModel, WithChunkReading, WithHeadingRow, ShouldQueue
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {

//        0 => "nazvanie_tovara"
//      1 => "ssylka_na_tovar"
//      2 => "nazvanie_bloka"
//      3 => "nazvanie"
//      4 => "cena"
//      5 => "ssylka_na_foto"
//      6 => "artikul"
//      7 => "opisanie"

        if(Product::where('code', $row['artikul'])->doesntExist()){


            $product_categories = [
                'id'=>2,
                'name'=>'Унитазы',
                'parent_id'=>0
            ];

            $info = [
                'name'=> $row['nazvanie'],
                'code'=> $row['artikul'],
                'price'=>str_replace("р.", "", $row['cena']),
                'amount'=>10,
                'description'=>$row['opisanie'],
                'brand_id'=>0,
                'brand'=>null,
                'collection_id'=>0,
                'collection'=> null,
                'categories'=>$product_categories,
                'categories_ids'=>[1],
                'chars'=>null,
                'product_type'=>1
            ];


            $product = Product::create($info);


            //Обрабатываем фото
            $photos = explode(';', $row['ssylka_na_foto']);
            foreach($photos as $i => $photo){
                try {
                    $result = Http::get($photo);
                } catch (RequestException) {
                    // domain doenst exist
                }

                if (!$result->failed()) {
                    if($i == 0){
                        $product->addMediaFromUrl($photo)->toMediaCollection('cover');
                    }else{
                        $product->addMediaFromUrl($photo)->toMediaCollection('photos');
                    }
                }


            }

        }

//        dd($product);
    }


    public function chunkSize(): int
    {
        return 5;
    }
}

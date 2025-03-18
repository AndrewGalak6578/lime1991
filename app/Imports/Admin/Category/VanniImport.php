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

class VanniImport implements ToModel, WithChunkReading, WithHeadingRow, ShouldQueue
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        /*
       "izobrazeniia"
       "izobrazeniia_faily"
       "nazvanie"
       "artikul"
       "cena"
       "valiuta"
       "nalicie"
       "brend"
       "kategoriia"
       "podkategoriia"
       "razdel"
       "url"
       "kratkoe_opisanie"
       "opisanie"
       "strana_brenda"
       "proizvoditel"
       "kollekciia"
       "cvet"
       "material"
       "garantiinyi_srok"
       "drugoe_nazvanie"
       "sirina"
       "vysota"
       "dlina"
       "obieem"
       "ves"
       "forma"
       "montaz"
       "pokrytie"
       "raspolozenie_sliva"
       "stilistika_dizaina"
       "strana_proizvodstva"
       "populiarnye_razmery"
       "poverxnost"
       "faily"
       "glubina"
       "osnashhenie"
       "staraia_cena"
       "sidene"
       "gidromassaz"
         "aeromassaz"
         "podsvetka_xromoterapiia"
        */


        if(Product::where('code', $row['artikul'])->doesntExist()){

        if(Brand::where('name', $row['brend'])->exists()){
            $brand = Brand::where('name', $row['brend'])->first();
        }else{
            $brand = Brand::create(['name'=>$row['brend']]);
        }

        $collection_id = 0;
        if($row['kollekciia'] != null){
            if(BrandCollection::where('name', $row['kollekciia'])->exists()){
                $collection = BrandCollection::where('name', $row['kollekciia'])->first();
            }else{
                $collection = BrandCollection::create([
                    'name'=>$row['kollekciia'],
                    'brand_id'=>$brand->id
                ]);
            }
            $collection_id = $collection->id;
        }else{
            $collection_id = 0;
        }


        $product_categories = [];
        $parent_category = ProductCategory::where('name', $row['podkategoriia'])->first();
        if(ProductCategory::where('name', $row['razdel'])->exists()){
            $second_category = ProductCategory::where('name', $row['razdel'])->first();
        }else{
            $second_category = ProductCategory::create([
                'name' => $row['razdel'],
                'parent_id' => $parent_category->id
            ])->first();
        }
        array_push($product_categories, [
            'id'=>$parent_category->id,
            'name'=>$parent_category->name,
            'parent_id'=>0
        ]);
        array_push($product_categories, [
            'id'=>$second_category->id,
            'name'=>$second_category->name,
            'parent_id'=>$second_category->parent_id
        ]);

        //Обрабатываем характеристики
            $row_chars = [
                "sirina",
                "vysota",
                "dlina",
                "obieem",
                "ves",
                "forma",
                "montaz",
                "pokrytie",
                "raspolozenie_sliva",
                "stilistika_dizaina",
                "strana_proizvodstva",
//                "populiarnye_razmery",
                "poverxnost",
//                "faily",
                "glubina",
                "osnashhenie",
//                "staraia_cena",
                "sidene",
                "gidromassaz",
                "aeromassaz",
                "podsvetka_xromoterapiia",
            ];

            $db_char_names = [
                "Ширина",
                "Высота",
                "Длина",
                "Объем",
                "Вес",
                "Форма",
                "Монтаж",
                "Покрытие",
                "Расположение слива",
                "Стилистика дизайна",
                "Страна производства",
//                "Популярные размеры",
                "Поверхность",
//                "Файлы",
                "Глубина",
                "Оснащение",
//                "Старая цена",
                "Сиденье",
                "Гидромассаж",
                "Аэромассаж",
                "Подсветка (Хромотерапия)",
            ];

            $product_chars = [];
            foreach ($db_char_names as $i => $db_char_name)
            {
                if($row[$row_chars[$i]] != null){
                    $categories = ProductCategory::find([$parent_category->id, $second_category->id]);
                    foreach ($categories as $k => $category){
                        $char = $category->chars()->where('name', $db_char_name)->first();
//                    foreach($chars as $char)
//                    {
                        if($char->values()->where('value', $row[$row_chars[$i]])->exists()){
                            $char_value = $char->values()->where('value', $row[$row_chars[$i]])->first();
                        }else{
                            $char_value = CharValue::create([
                                'char_id' => $char->id,
                                'value' => $row[$row_chars[$i]]
                            ]);
                        }
                        if($k == 0){
                            array_push($product_chars, [
                                'id'=>$char_value->id,
                                'name'=>$db_char_name,
                                'value'=>$row[$row_chars[$i]]
                            ]);
                        }
//                    }
                    }
                }

            }


        $info = [
            'name'=> $row['nazvanie'],
            'code'=> $row['artikul'],
            'price'=>$row['cena'],
            'amount'=>10,
            'description'=>$row['opisanie'],
            'brand_id'=>$brand->id,
            'brand'=>[
                'id'=>$brand->id,
                'name'=>$brand->name,
                'cover'=>$brand->cover
            ],
            'collection_id'=>$collection_id,
            'collection'=>($collection_id != 0) ? [
                'id'=>$collection->id,
                'name'=>$collection->name,
                'brand_id'=>$collection->brand_id
            ] : null,
            'categories'=>$product_categories,
            'categories_ids'=>[$parent_category->id, $second_category->id],
            'chars'=>$product_chars
//            'tags'=>null,
//            'labels'=>$row[''],
//            'cover'=>$row[''],
//            'photos'=>$row[''],
//            'seo_title'=>$row[''],
//            'seo_description'=>$row[''],
//            'breadcrumb_name'=>$row[''],
//            'status'=>$row[''],
        ];


        $product = Product::create($info);


        //Обрабатываем фото
        $photos = explode(';', $row['izobrazeniia']);
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

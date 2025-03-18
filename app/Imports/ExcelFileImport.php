<?php

namespace App\Imports;

use App\Models\BlockProduct;
use App\Models\Brand;
use App\Models\BrandCollection;
use App\Models\CharValue;
use App\Models\ExcelFile;
use App\Models\Product;
use App\Models\ProductBlock;
use App\Models\ProductCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelFileImport implements ToModel, WithCalculatedFormulas, WithChunkReading, WithHeadingRow, ShouldQueue
{

    public $excelFile;
    public $params;
    public $chars;
    public $excel_page;

    public function __construct($excelFile)
    {
        $this->excelFile = ExcelFile::find($excelFile);

        $this->params = $this->excelFile->params()->get();

        $this->excel_page = $this->excelFile->page;
//        dd($this->excel_page);
    }
//
//    public function sheets(): array
//    {
//        return [
//            $this->excel_page => $this,
//        ];
//    }

    //Проверяем есть ли такой параметр в настройках файла импорта
    public function hasParam($param)
    {
        return $this->excelFile->params()->where('param', $param)->exists();
    }

    //Получаем ключ колонки которую хотим тянуть
    public function getParamColumn($param)
    {

        return $this->excelFile->params()->where('param', $param)->first()->column;
    }

    //Конвертируем из мм в см
    public function mm_to_cm($value)
    {
        if (is_numeric($value)) {
            $cm = $value / 10;
            return $cm;
        }
    }

    //Обрабатываем значение характеристики
    public function handleCharValue($param, $char, $char_value)
    {
        //Проверяем если значения заменяемые то находим нужное заменяемое-значение в базе либо просто подтягиваем значение
        if($param->change_value){

            $setting = $param->charSettings()->where('excel_name', $char_value)->first();
            $charValue = $setting->charValue;
        }else{
            $charValue = $char->values()->where('value', $char_value)->first();
        }

        //Если ничего не найдено и указано чтобы не пропускать новые значения то создаем новое значение в базе данных
        if($charValue == null AND !$param->skip_new_values){
            if($char_value != null){
                $charValue = CharValue::create([
                    'value' => $char_value,
                    'char_id' => $char->id
                ]);
            }
        }

        //Добавляем значение в список характеристик
        if($charValue != null AND $char_value != null){
            $this->chars[] = [
                'id' => $charValue->id,
                'charId' => $char->id,
                'name' => $char->name,
                'value' => $charValue->value
            ];
        }
    }


    function checkYandexLink($url) {
        $host = parse_url($url, PHP_URL_HOST);

        if ($host == 'yadi.sk' OR $host == 'disk.yandex.ru') {
            return true;
        } else {
            return false;
        }
    }


    function getYandexLinkDownloadUrl($url)
    {

        $response = Http::get('https://lime-photo.pr100kot.com/api/photo?photo='.$url);

        if($response->status() == 200){
            return json_decode($response->getBody(), true)['data']['fileName'];
        }else{
            return null;
        }
    }



    /**
     * @param array $row
     */
    public function model(array $row)
    {

        $this->chars = [];

        //Артикул
        $code = $row[$this->getParamColumn('product_code')];
//        Log::error($code);
//        Log::error($row[$this->getParamColumn('product_description')]);

        //TODO тут поправить

            //Бренд и коллекция
            $brand = Brand::firstOrCreate(['name' => $row[$this->getParamColumn('brand')]]);

            if($this->hasParam('collection')){
                if($row[$this->getParamColumn('collection')] != null){
                    $collection = BrandCollection::firstOrCreate([
                        'name'=> $row[$this->getParamColumn('collection')],
                        'brand_id' => $brand->id
                    ]);
                }
            }

            //Категория или категории товара
            if($this->excelFile->category->parent_id != 0){
                $parent_category = $this->excelFile->category->parentCategory;
                $second_category = $this->excelFile->category;
                $product_categories_ids = [$parent_category->id, $second_category->id];
                $product_categories = ProductCategory::findMany([$second_category->id, $parent_category->id]);
            }else{
                $parent_category = $this->excelFile->category;
                $product_categories_ids = [$parent_category->id];
                $product_categories = ProductCategory::findMany([$parent_category->id]);
            }

            //Характеристики товара
            $excelFileChars = $this->excelFile->params()->where('param', 'char')->get();
            foreach ($excelFileChars as $excelFileChar)
            {
                $char = $excelFileChar->char;
                $char_value = $row[$excelFileChar->column];
                if($excelFileChar->mm_to_cm == true){
                    $char_value = $this->mm_to_cm($char_value);
                }
                if($char_value){

                    $this->handleCharValue($excelFileChar, $char, $char_value);
                }
            }


            //Название товара
            $name = $row[$this->getParamColumn('product_name')];

            if($this->excelFile->names()->count() > 0){
                $name = '';
                foreach($this->excelFile->names()->get() as $excelParamName){


                    if($excelParamName->type == 0){
                        $name .= ' '.$excelParamName->text.' ';
                    }else{
                        if($excelParamName->param->param == 'product_code'){
                            $name .= $code.' ';
                        }

                        if($excelParamName->param->param == 'brand'){
                            $name .= $brand->name.' ';
                        }

                        if($excelParamName->param->param == 'collection'){
                            $name .= $collection->name.' ';
                        }


                        if($excelParamName->param->param == 'char'){
                            $char_id = $excelParamName->param->char_id;
                            $excelChar = $this->excelFile->params()->where('char_id', $char_id)->first();
                            if($excelParamName->param->mm_to_cm){
                                $mm_to_cm = $this->mm_to_cm($row[$excelChar->column]);
                                $name .= $mm_to_cm.' ';
                            }else{
                                $name .= $row[$excelChar->column].' ';
                            }
                        }
                    }


                }
            }

            //Определяем доп товар
            $product_type = 0;
//            Log::error($this->hasParam('dop_block'));
//            Log::error($this->getParamColumn('dop_block'));
            if($this->hasParam('dop_block'))
            {
//                Log::error($row[$this->getParamColumn('dop_block')]);
                $block = ProductBlock::firstOrCreate(['name'=> $row[$this->getParamColumn('dop_block')]]);

//                Log::error($block);

                if($block)
                {
                    $product_type = $block->id;
                }

                if($row[$this->getParamColumn('dop_block')] == 'ванна'){
                    $product_type = 0;
                }
            }



            //Основная информация о товаре
            $info = [
                'name'=> $name,
                'code'=> $code,
                'price'=>($this->hasParam('product_price')) ? $row[$this->getParamColumn('product_price')] : 0,
                'amount'=>($this->hasParam('product_amount')) ? $row[$this->getParamColumn('product_amount')] : 10,
                'description'=>($this->hasParam('product_description')) ? $row[$this->getParamColumn('product_description')] : null,
                'brand_id'=>$brand->id,
                'brand'=>[
                    'id'=>$brand->id,
                    'name'=>$brand->name,
                    'cover'=>$brand->cover
                ],
                'collection_id'=>(isset($collection)) ? $collection->id : 0,
                'collection'=>(isset($collection)) ? [
                    'id'=>$collection->id,
                    'name'=>$collection->name,
                    'brand_id'=>$collection->brand_id
                ] : null,
                'categories'=>$product_categories,
                'categories_ids'=>$product_categories_ids,
                'chars'=>(isset($this->chars)) ? $this->chars : [],
                'seo_title'=>($this->hasParam('seo_title')) ? $row[$this->getParamColumn('seo_title')] : null,
                'seo_description'=>($this->hasParam('seo_description')) ? $row[$this->getParamColumn('seo_description')] : null,
                'breadcrumb_name'=>($this->hasParam('seo_breadcrumb')) ? $row[$this->getParamColumn('seo_breadcrumb')] : null,
                'product_type'=>$product_type
            ];

//            Log::error($info);

//            dd($info);

            //Создаём товар в базе данных
        if(Product::where('code', $code)->doesntExist()) {
            $product = Product::create($info);
        } else{
            $product = Product::where('code', $code)->first();
            $product->update($info);
        }

            //Обрабатываем обложку
            if($this->hasParam('product_photo_cover')){
                $get_cover_url = $row[$this->getParamColumn('product_photo_cover')];

                if($get_cover_url != null){
//                    $headers = @get_headers($url);
                    $covers = explode(';', $get_cover_url);
                    if($covers != null){
                        $url = $covers[0];
                        if ($this->checkYandexLink($url)) {

                            if($this->getYandexLinkDownloadUrl($url) != null){

                                $url = $this->getYandexLinkDownloadUrl($url);

                            }
                        }
                        if($url != null){
                            $product->addMediaFromUrl($url)->toMediaCollection('cover');
                        }
                    }
//                    Log::warning($headers);
//                    if ($headers && strpos($headers[0], '200') !== false) {


                }
//                }

            }
//
//            //Обрабатываем фотографии
            if($this->hasParam('product_photos')){
                $photos = $this->excelFile->params()->where('param', 'product_photos')->get();
                foreach($photos as $i => $photo){
                    $get_string_url = $row[$photo->column];

                    if($get_string_url != null){
                        $get_urls = explode(';', $get_string_url);
//                        $headers = @get_headers($url);
//                        if ($headers && strpos($headers[0], '200') !== false) {
                        foreach ($get_urls as $url){
                            if ($this->checkYandexLink($url)) {
                                if($this->getYandexLinkDownloadUrl($url) != null){
                                    $url = $this->getYandexLinkDownloadUrl($url);
                                }
                            }

                            $product->addMediaFromUrl($url)->toMediaCollection('photos');
                        }

//                        }
                    }
                }
            }

            //Добавляем доп товары
            if($this->hasParam('dop')){

                $product_type_text = $row[$this->getParamColumn('dop')];

                $product_ids = explode("; ", $product_type_text);
                $products = Product::whereIn('code', $product_ids)->get();
//                Log::error('dop_product');
//                Log::error($products);
                foreach($products as $dop_product)
                {
                    if($dop_product->product_type != 0){
                        BlockProduct::create([
                            'product_block_id'=>$dop_product->product_type,
                            'related_product_id'=>$dop_product->id,
                            'product_id'=>$product->id
                        ]);
                    }
                }
            }

            unset($this->chars);





    }

    public function chunkSize(): int
    {
        return 25;
    }
}

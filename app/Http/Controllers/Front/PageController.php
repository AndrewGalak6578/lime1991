<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Char;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    public function show(Request $request ,$slug)
    {
        if(Page::where('slug', $slug)->exists()){
            $page = Page::where('slug', $slug)->first();
            if($page->view == null){
                return view('front.pages.show', [
                    'page' => $page
                ]);
            }else{
                return view('front.pages.'.$page->view, [
                    'page' => $page
                ]);
            }
        }else{
            $productCategory = ProductCategory::where('slug', $slug)->with('parentCategory.parentCategory')->firstOrFail();

            $ranges = [
                'price' => [
                    'min' => Product::min('price'),
                    'max' => Product::max('price')
                ]
            ];
            $chars = $productCategory->chars()->where('show_in_filter', 1)->where('type', 1)->get();
            $products = $productCategory->products()->get();
            foreach ($chars as $char) {
                // Проходимся по всем продуктам и собираем значения характеристик
                $charValues = $products->map(function($product) use ($char) {
                    $charsCollection = collect($product->chars);

                    // Находим характеристику с нужным нам charId и возвращаем ее значение (value)
                    $foundChar = $charsCollection->where('charId', $char->id)->first();

                    if ($foundChar) {
                        // Если значение является числом, возвращаем как есть, в противном случае преобразуем в 0
                        return is_numeric($foundChar['value']) ? (float)$foundChar['value'] : 0;
                    }

                    return 0;
                });

                // Теперь у нас есть коллекция значений для этой характеристики, найдем минимум и максимум
                $minValue = $charValues->min();
                $maxValue = $charValues->max();

                // Обновляем данные в ответе
                $ranges['filters'][$char->slug] = [
                    'min-value' => $minValue,
                    'max-value' => $maxValue,
                ];
            }

            $data = $request->all();
            $products = $productCategory->products()->filter($data)->where('status', '!=', 5)->where('product_type',0)->with('media')->paginate(20);
            $brands = Brand::all();

            return view('front.categories.show', [
                'productCategory'=>$productCategory,
                'products' => $products,
                'data' => $data,
                'ranges' => $ranges,
                'brands' => $brands,
            ]);


        }



    }

    function mergeDataRecursively(&$originalData, $requestData) {
        foreach ($requestData as $key => $value) {
            // Проверка, есть ли ключ в исходных данных и является ли значение массивом
            if (isset($originalData[$key]) && is_array($value)) {
                // Если оба значения (в исходном массиве и в данных запроса) являются массивами, идём глубже
                if(is_array($originalData[$key])){
                    $this->mergeDataRecursively($originalData[$key], $value);
                } else{
                    // Если в исходных данных не массив, а в новых данных — массив,
                    // просто заменяем значение исходного ключа на новый массив
                    $originalData[$key] = $value;
                }
            } else {
                // Если значение по ключу не массив или ключ не найден в исходных данных,
                // просто обновляем значение (или создаём новый ключ)
                $originalData[$key] = $value;
            }
        }
    }
}

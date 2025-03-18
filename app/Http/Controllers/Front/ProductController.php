<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlockProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Показать товар
    public function show(Product $product)
    {
        abort_if($product->isHidden(), 404);

        $groupedProducts = $product->blockProductsTwo->groupBy(function ($item) {
     
            $compact = collect($item->chars)->where('name', 'Тип комплектующих')->first();
            if ($compact)  return $compact['value'] ?? 'Не определён';

            $accessory = collect($item->chars)->where('name', 'Тип аксессуара')->first();
            return $accessory['value'] ?? 'Не определён';
        });
//        dd(Product::where('code', 'Z.RU93.0.290.5')->first()->chars);
        return view('front.products.show', [
            'product' => $product,
            'products'=>Product::whereJsonContains('categories_ids', $product->categories_ids)->where('product_type', 0)->take(8)->get(),
            'groupedProducts' => $groupedProducts
//            'moreProducts'=>$moreProducts
        ]);
    }

}

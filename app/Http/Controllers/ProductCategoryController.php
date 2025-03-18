<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function show(ProductCategory $productCategory)
    {

        $products = $productCategory->products();

        if(request()->has('chars')){
            $new_products = [];
            foreach(request()->get('chars') as $char){
                $new_products = $products->whereJsonContains('chars->value', $char);
            }

            dd($new_products);

        }else{
            $products = $productCategory->products()->paginate(20);
        }

        return view('front.categories.show', [
            'productCategory'=>$productCategory,
            'products' => $products
        ]);
    }
}

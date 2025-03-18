<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
//        return \DB::table('products')->select(['id', 'name', 'code'])->get();
        //Product::select(['id', 'name', 'code'])->get();
//        return ProductResource::collection(Product::select(['id', 'name', 'code'])->get());

        $term = $request->q;

        if (empty($term)) {
            return \Response::json([]);
        }

        $products = Product::search($term)->get();


        $formatted_products = [];

        foreach ($products as $product) {
            $formatted_products[] = ['id' => $product->id, 'text' => $product->name];
        }

        return \Response::json($formatted_products);

    }
}

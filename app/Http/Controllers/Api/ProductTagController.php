<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductTagResource;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductTagController extends Controller
{
    public function index()
    {
//        dd(request()->get('categories'));
        if(request()->has('categories')){
            $tags = ProductTag::where('product_category_id', 0)->orWhereIn('product_category_id', request()->get('categories'))->get();
//            dd($tags);
//            $tags = new Collection();
//            foreach(request()->get('categories') as $cat){
//                $category = ProductCategory::find($cat);
//                foreach ($category->tags()->get() as $tag){
//
//                }
//            }
//            dd($tags)
            return ProductTagResource::collection($tags);
        }else{
            return ProductTagResource::collection(ProductTag::all());
        }
    }
}

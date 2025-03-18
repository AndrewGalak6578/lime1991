<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CharValuesResource;
use App\Models\Char;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CharController extends Controller
{
    public function index()
    {
//        $categories = ProductCategory::findIn(request()->get('categories'));
        $chars = Char::whereIn('category_id', request()->get('categories'))->get();
//        dd($chars);

        return view('admin.products.products.parts.store.chars-form', [
           'chars'=>$chars
        ]);
    }

    public function getCharValues(Char $char)
    {
        return $char->values()->get();
    }

    public function getChars(Request $request)
    {
        return ProductCategory::find($request['category_id'])->chars()->get();
    }
}

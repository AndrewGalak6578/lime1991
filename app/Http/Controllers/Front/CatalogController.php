<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CatalogController extends Controller
{
    public function show()
    {
        return view('front.catalog.show', [
					"categories" => ProductCategory::select(['id', 'name', 'slug', 'icon', 'cover', 'parent_id'])->where('parent_id', 0)->orderBy('id', 'asc')->get(),
        ]);
    }
}

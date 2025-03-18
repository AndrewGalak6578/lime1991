<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function show(Brand $brand, Request $request) {
			$categoryFilter = $request->query('category');
			
			if ($categoryFilter !== null) {
				$categories_ids = ProductCategory::getSubcategoryIds($categoryFilter);
				array_push($categories_ids, $categoryFilter);
        $products = $brand->products()->where(function ($query) use ($categories_ids) {
            foreach ($categories_ids as $id) {
                $query->orWhereJsonContains('categories_ids', $id);
            }
        })->paginate(20);
			} else {
				$products = $brand->products()->paginate(20);
			}
	
			return view('front.brands.show', [
				'brand' => $brand,
				'brands' => Brand::all(),
				'products' => $products
			]);
    }

    public function brands()
    {
        return view('front.brands.show', [
            'brands' => Brand::all(),
            'products' => Product::all()->paginate(20)
        ]);
    }
}

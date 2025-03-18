<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
			$category_id = (int) $request['c'];
			$term = $request['q'];

			if (empty($term)) {
				return \Response::json([]);
			}

			$products = Product::getFromCategory($category_id)->search($term)->paginate(10);

			$html = view('front.products.search', [
					'products' => $products
			]);

			return $html;
    }

    public function searchPage(Request $request)
    {
			$category_id = (int) $request['c'];
			$term = $request['q'];
			if (empty($term)) {
				return back();
			}
			$products = Product::getFromCategory($category_id)->search($term)->paginate(20);

			return view('front.search.index', [
				'products' => $products
			]);
    }
}

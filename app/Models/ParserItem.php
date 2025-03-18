<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParserItem extends Model
{
	use HasFactory;

	protected $guarded = ['id'];
	protected $casts = [
		'chars' => 'array',
		'images' => 'array',
		'chain' => 'array',
	];

	public function getCategories() {
		//
	}

	public function getProducts() {
		//
	}

	public function getBrands() {
		//
	}

	public static function createCategory($url, $name, $parent_id) {
		$obj = new ParserItem([
			'type' => 'category',
			'url' => $url,
			'name' => $name,
		]);
		if ($parent_id !== null) {
			$obj->category = $parent_id;
		}
		$obj->save();
		return $obj;
	}

	public static function createProduct($url, $name, $article, $desc, $price, $store, $images, $chars, $chain, $category) {
		$obj = new ParserItem([
			'type' => 'product',
			'url' => $url,
			'name' => $name,
			'article' => $article,
			'desc' => $desc,
			'price' => $price,
			'store' => $store,
			'images' => $images,
			'chars' => $chars,
			'chain' => $chain,
		]);
		$obj->category = $category;
		$obj->save();
		return $obj;
	}

	public static function createBrand($url, $name, $logo_url, $desc) {
		$obj = new ParserItem([
			'type' => 'brand',
			'url' => $url,
			'name' => $name,
			'logo_url' => $logo_url,
			'desc' => $desc,
		]);
		$obj->save();
		return $obj;
	}

}

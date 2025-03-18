<?php

namespace App\Services;

use App\Models\ParserItem;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\BrandCollection;
use App\Models\Char;
use App\Models\CharValue;
use Spatie\MediaLibrary\MediaCollections\Exceptions;

const BASE_URL = 'https://cs-online.su';

class ParserItemToBase{

	public function upload() {
		/**
		 * Получаем категории
		 * categories_ids_keys - массив с id таблицы ParserItems
		 * для дальнейшей синхронизации с id из базы ProductCategories.
		 * Структура: [id_Parsers => id_ProductCategories]
		 */
		$categories_ids_keys = [];
		$categories = ParserItem::where('type', 'category')->whereNull('category')->get();
		echo "Now: ".$categories->count()." categories\n";
		foreach ($categories as $_category) {
			if (!$newCategory = ProductCategory::where('name', $_category->name)->first()) {
				$newCategory = new ProductCategory([
					'name' => $_category->name,
				]);
				$newCategory->save();
			}
			$categories_ids_keys[$_category->id] = $newCategory->id;
		}
		unset($categories);

		/**
		 * Получаем подкатегории
		 */
		$subcategories = ParserItem::where('type', 'category')->whereNotNull('category')->get();
		echo "Now: ".$subcategories->count()." subcategories\n";
		foreach ($subcategories as $_subcategory) {
			if (!$newSubcategory = ProductCategory::where('name', $_subcategory->name)->first()) {
				$newSubcategory = new ProductCategory([
					'name' => $_subcategory->name,
					'parent_id' => $categories_ids_keys[$_subcategory->category],
				]);
				$newSubcategory->save();
			}
			$categories_ids_keys[$_subcategory->id] = $newSubcategory->id;
		}
		unset($subcategories);

		/**
		 * Получаем бренды
		 */
		$brands_ids_keys = [];
		$brands = ParserItem::where('type', 'brand')->get();
		echo "Now: ".$brands->count()." brands\n";
		foreach ($brands as $_brand) {
			if (!$newBrand = Brand::where('name', $_brand->name)->first()) {
				$newBrand = new Brand([
					'name' => $_brand->name,
				]);
				$newBrand->addMediaFromUrl($_brand->logo_url)->toMediaCollection('logo');
				usleep(500*1000);
				$newBrand->save();
			}
			$brands_ids_keys[mb_strtolower(trim($_brand->name))] = $newBrand->id;
		}
		unset($brands);

		/**
		 * Получаем продукцию
		 */
		$url_to_product_id = [];
		$products = ParserItem::where('type', 'product')->get();
		echo "Now: ".$products->count()." products\n";
		foreach ($products as $_p_key => $_product) {
			if (!$newProduct = Product::where('code', $_product->article)->first()) {
				$newProduct = new Product([
					'name' => $_product->name,
				]);

				// Цена
				$newProduct->price = $_product->price;

				// Артикул
				$newProduct->code = $_product->article;

				// Категория
				$newProduct->categories_ids = [$categories_ids_keys[$_product->category]];
				/* $newProduct->categories = [
					[
						'name' => 
					],
				]; */

				// Характеристики
				$chars = [];
				if (is_string($_product->chars)) {
					$_product->chars = json_decode($_product->chars);
				}
				foreach (array_keys($_product->chars) as $_char_key) {
					$char_name = trim($_char_key);
					$char_value = trim($_product->chars[$_char_key]);
					switch (mb_strtolower($char_name)) {
						case 'бренд':
							// Бренд
							if (in_array(mb_strtolower($char_value), array_keys($brands_ids_keys))) {
								$newProduct->brand_id = $brands_ids_keys[mb_strtolower($char_value)];
							}
							break;

						case 'серия':
							$brand_collection = BrandCollection::where('name', $char_value)->first();
							if (!$newProduct->brand_id) continue 2;
							if (!$brand_collection) {
								$brand_collection = new BrandCollection([
									'name' => $char_value,
									'brand_id' => $newProduct->brand_id,
								]);
								$brand_collection->save();
							}
							$newProduct->collection_id = $brand_collection->id;
							break;

						default:
							//
							break;
					}

					// Характеристики
					$char = Char::where('category_id', $newProduct->categories_ids[0])->where('name', $char_name)->first();
					if (!$char) {
						$char = new Char([
							'name' => $char_name,
							'category_id' => $newProduct->categories_ids[0],
						]);
						$char->save();
					}

					// Описание
					if (!empty($_product->desc)) {
						$newProduct->description = $_product->desc;
					}

					// Значения
					$charVal = CharValue::where('char_id', $char->id)->where('value', $char_value)->first();
					if (!$charVal) {
						$charVal = new CharValue([
							'value' => $char_value,
							'char_id' => $char->id,
						]);
						$charVal->save();
					}

					$chars[] = [
						'charId' => $char->id,
						'valId' => $charVal->id,
						'name' => $char_name,
						'value' => $char_value
					];
				}
				$newProduct->chars = $chars;

				// Изображения
				if (is_string($_product->images)) {
					$_product->images = json_decode($_product->images);
				}
				foreach ($_product->images as $key => $_image) {
					$_tries = 0;
					while ($_tries < 3) {
						$_tries++;
						try {
							$_image_url = parse_url($_image);
							if (!isset($_image_url['scheme'])) {
								$_image = BASE_URL.$_image;
							}
							$_image = $newProduct->addMediaFromUrl($_image);
							if ($key === 0) {
								$_image->toMediaCollection('cover');
							} else {
								$_image->toMediaCollection('photos');
							}
							$newProduct->save();
							$_tries = 1000;
							break;
						} catch (\Exception $e) {
							sleep($_tries);
						}
					}
					if ($_tries < 1000) {
						echo "Не удалось получить изображение: (".$_image.") ".$_tries."\n";
					}
				}

				$newProduct->save();
			}
			$url_to_product_id[$_product->url] = $newProduct->id;

			/* if ($key % 50 == 0) {
				sleep(10);
			} */
			if ($_p_key % 100 == 0) {
				echo "Now: ".$_p_key."/".$products->count()."\n";
			}
		}
		unset($products);

		$url_to_product_id_keys = array_keys($url_to_product_id);
		$products_w_chain = ParserItem::where('type', 'product')->whereJsonLength('chain', '>', 0)->get();
		echo "Now: ".$products_w_chain->count()." chained products\n";
		foreach ($products_w_chain as $_product) {
			if (!in_array($_product->url, $url_to_product_id_keys)) continue;
			$product = Product::find($url_to_product_id[$_product->url]);
			if (!$product) continue;
			if (is_string($_product->chain)) {
				$_product->chain = json_decode($_product->chain);
			}
			foreach ($_product->chain as $_chain) {
				if (!in_array($_chain, $url_to_product_id_keys)) continue;
				$product->relatedProducts()->attach($url_to_product_id[$_chain]);
			}
			$product->save();
		}
		unset($products_w_chain);

	}

}

<?php

namespace App\Imports\Admin;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithLimit;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\Char;
use App\Models\CharValue;

class ExcelImport implements ToArray, WithChunkReading, WithStartRow, SkipsEmptyRows/*, WithLimit*/
{
	private $category;
	private $fields;
	private $chars = [];
	private $count = 0;
	private $table_names = [];
	private $addedProducts = [];

	public function __construct($config)
	{
		if (isset($config['category'])) {
			$this->category = $config['category'];
		}
		if (isset($config['fields'])) {
			$this->fields = $config['fields'];
		}
		if (isset($config['chars'])) {
			$this->chars = $config['chars'];
		}
	}

	public function array(array $array)
	{
		if (empty($this->table_names)) {
			$this->table_names = array_splice($array, 0, 1)[0];
		}

		if (empty($this->category) || empty($this->chars) || empty($this->fields)) {
			return false;
		}
		
		$category = ProductCategory::where('id', $this->category)->first();
		if (!$category) {
			return false;
		}
		
		$category_chars = [];
		foreach ($category->chars as $_char) {
			$category_chars[$_char->id] = $_char;
		}

		foreach ($array as $key => $row) {
			if (!$brand = Brand::where('name', $row[$this->fields['brand']])->first()) {
				$brand = new Brand([
					'name' =>  $row[$this->fields['brand']],
				]);
				$brand->save();
			}
			if (!$product = Product::where('code', $row[$this->fields['article']])->first()) {
				$product = new Product([
					'name' => $row[$this->fields['name']],
				]);
			}

			// Цена
			$product->price = $row[$this->fields['price']];

			// Артикул
			$product->code = $row[$this->fields['article']];

			// Категория
			$product->categories_ids = [$category->id];

			// Бренд
			$product->brand_id = $brand->id;

			// Описание
			if (!empty($this->fields['desc'])) {
				$product->description = $row[$this->fields['desc']];
			}
			
			// Характеристики
			$chars = [];
			foreach (array_keys($this->chars) as $char_key) {
				$char_name = ($this->chars[$char_key] !== 0 ? $category_chars[$this->chars[$char_key]]->name : trim($this->table_names[$char_key]));
				$char_value = $row[$char_key];
				if (empty($char_value)) {
					break;
				}
				$chars[] = ['name' => $char_name, 'value' => $char_value];

				if (!$char = Char::where('category_id', $product->categories_ids[0])->where('name', $char_name)->first()) {
					$char = new Char([
						'name' => $char_name,
						'category_id' => $product->categories_ids[0],
					]);
					$char->save();
				}
				$charVal = CharValue::where('char_id', $char->id)->where('value', $char_value)->first();
				if (!$charVal) {
					$charVal = new CharValue([
						'value' => $char_value,
						'char_id' => $char->id,
					]);
					$charVal->save();
				}
				$product->chars = $chars;
			}

			// Изображения
			$photos = [];
			if ($row[$this->fields['photo']]) {
				$photos = explode(';', $row[$this->fields['photo']]);
				foreach ($photos as $key => $_image) {
					$_tries = 0;
					while ($_tries < 3) {
						$_tries++;
						try {
							$_image_url = parse_url($_image);
							if (!isset($_image_url['scheme'])) {
								$_image = $_image;
							}
							$_image = $product->addMediaFromUrl($_image);
							if ($key === 0) {
								$_image->toMediaCollection('cover');
							} else {
								$_image->toMediaCollection('photos');
							}
							$product->save();
							$_tries = 1000;
							break;
						} catch (\Exception $e) {
							sleep($_tries);
						}
					}
					if ($_tries < 1000) {
						// echo "Не удалось получить изображение: (".$_image.") ".$_tries."\n";
					}
				}
			}

			$product->save();
			array_push($this->addedProducts, [route('front.products.show', $product->slug), $product->name]);
		}

		return true;
	}

	public function getResult()
	{
		return $this->addedProducts;
	}

	public function startRow(): int
	{
		return 1;
	}

	/* public function limit(): int
	{
		return 2;
	} */

	public function chunkSize(): int
	{
		// return 5000;
		return 1000;
	}
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Char;
use App\Models\CharValue;

class ToolFixProductsCharsCommand extends Command
{
	protected $signature = 'tool:fixProductsChars';
	protected $description = 'Исправление характеристик товаров';

	public function handle()
	{
		$products = Product::all();
		foreach ($products as $key => $product) {
			$chars = [];
			foreach ($product->chars as $ckey => $pchar) {
				$char = Char::where('category_id', $product->categories_ids[0])->where('name', $pchar['name'])->first();
				if (!$char) {
					$char = new Char([
						'name' => $char['name'],
						'category_id' => $product->categories_ids[0],
					]);
					$char->save();
				}

				// Значения
				$charVal = CharValue::where('char_id', $char->id)->where('value', $pchar['value'])->first();
				if (!$charVal) {
					$charVal = new CharValue([
						'value' => $pchar['value'],
						'char_id' => $char->id,
					]);
					$charVal->save();
				}

				$chars[] = [
					'charId' => $char->id,
					'valId' => $charVal->id,
					'name' => $pchar['name'],
					'value' => $pchar['value']
				];
			}
			$product->chars = $chars;
			$product->save();
		}
	}
}

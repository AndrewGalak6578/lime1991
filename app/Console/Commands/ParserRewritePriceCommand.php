<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParserItem;
use App\Models\Product;
use PHPHtmlParser\Dom;

class ParserRewritePriceCommand extends Command
{
	protected $signature = 'parser:rewritePrice';
	protected $description = 'Перезапись пропущенных цен';

	public function handle()
	{
		$products = Product::where('price', 0)->get();
		$count = $products->count();
		foreach ($products as $key => $product) {
			$parserItem = ParserItem::where('article', $product->code)->first();
			if ($parserItem) {
				$product->price = $parserItem->price;
				$product->save();
			}
			echo "code: ".$product->code." (".$key."/".$count.") (".$product->price.")\n";
		}
	}
}

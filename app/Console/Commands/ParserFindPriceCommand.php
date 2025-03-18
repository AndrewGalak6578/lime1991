<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParserItem;
use App\Models\Product;
use PHPHtmlParser\Dom;

class ParserFindPriceCommand extends Command
{
	protected $signature = 'parser:findPrice';
	protected $description = 'Восстановление пропущенных цен';

	public function handle()
	{
		// ParserItem::where('type', 'product')->where('price', 151418)->update(['price' => 0]);
		$products = ParserItem::where('type', 'product')->where('price', 0)->get();
		$count = $products->count();
		foreach ($products as $key => $product) {
			$dom = new Dom;
			$dom->loadFromUrl($product->url);

			$price_el = $dom->find('.product-side .cost.prices .prices-wrapper .price');
			if ($price_el->count() >= 1) {
				$_price = (int) ceil($price_el[$price_el->count() - 1]->getAttribute('data-value'));
				if (empty($_price)) {
					$_price = 0;
					$_price_el = $price_el->find('.price_value');
					if ($_price_el->count() >= 1) {
						$_price = (int) preg_replace('/(&nbsp;|[А-Яа-я]|\.|\s)+/ui', '', $_price_el[0]->text);
					}
				}
				if (empty($_price)) {
					$_price = 0;
					$_price_el = $price_el->find('.price_value_block');
					if ($_price_el->count() >= 1) {
						$_price = (int) preg_replace('/(&nbsp;|[А-Яа-я]|\.|\s)+/ui', '', $_price_el[0]->text);
					}
				}
				$product->price = $_price;
				$product->save();
				$prod = Product::where('code', $product->article)->first();
				if ($prod) {
					$prod->price = $_price;
					$prod->save();
				}
				echo "code: ".$product->article." (".$key."/".$count.") (".$_price.") (".$product->url.")\n";
			} else {
				echo "code: ".$product->article." (".$key."/".$count.") (".$product->url.")\n";
			}
		}
	}
}

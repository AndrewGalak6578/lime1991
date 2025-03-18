<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParserItem;
use PHPHtmlParser\Dom;

class ParserFindImagesCommand extends Command
{
	protected $signature = 'parser:findImages';
	protected $description = 'Восстановление пропущенных изображений';

	public function handle()
	{
		$products = ParserItem::where('type', 'product')->whereJsonLength('images', '<=', 0)->get();
		$count = $products->count();
		foreach ($products as $key => $product) {
			$dom = new Dom;
			$dom->loadFromUrl($product->url);
			$images_el = $dom->find('.product-detail-gallery__link');
			$newImages = [];
			if ($images_el->count() > 0) {
				foreach ($images_el as $image_el) {
					$img_url = $image_el->getAttribute('href');
					if ($img_url == null) continue;
					$newImages[] = $img_url;
				}
				echo "code: ".$product->article." (".$key."/".$count.") \n";
			}
			$product->images = $newImages;
			$product->save();
		}
	}
}

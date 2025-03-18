<?php

namespace App\Services;

// header('Content-Type: text/plain');

// set_time_limit (0);
// ini_set("memory_limit", "1024M");
// ini_set("memory_limit", "0");

require_once app_path('/Services/CSOnlineParserIncludes/category.php');
require_once app_path('/Services/CSOnlineParserIncludes/product.php');
require_once app_path('/Services/CSOnlineParserIncludes/brand.php');
require_once app_path('/Services/CSOnlineParserIncludes/url.php');

use CSOnlineParserServiceClasses\Category;
use CSOnlineParserServiceClasses\Product;
use CSOnlineParserServiceClasses\Brand;
use CSOnlineParserServiceClasses\Url;
use PHPHtmlParser\Dom;

use App\Models\Parser;
use App\Models\ParserItem;

const BASE_URL = 'https://cs-online.su';

class CSOnlineParserService {

	/**
	 * База данных для данных
	 * полученых из парсинга
	 */
	private $DataBase = [];

	/**
	 * База данных для брендов
	 * полученых из парсинга
	 */
	private $BrandsBase = [];

	/**
	 * База данных для ссылок
	 * полученых из парсинга
	 * для поиска категории и товаров по ним
	 */
	// $UrlsBase = [];

	private $ParserState;

	public function parse() {
		$dom = new Dom;
		$this->loadDomFromUrl(BASE_URL.'/catalog/', $dom);

		$this->ParserState = Parser::create(['pid' => getmypid()]);

		/**
		 * Парсим все категории
		 */
		$categories = $dom->find('.cs-popular-item');
		$this->ParserState->max_categories += $categories->count();
		$this->ParserState->max_save += $categories->count();
		$this->ParserState->save();
		$_categories = [];
		foreach ($categories as $category) {
			$_categories[] = new Category($category->getAttribute('href'), BASE_URL);
		}

		/**
		 * Парсим подкатегории и товары
		 */
		$this->parseItems($_categories);

		$this->ParserState->status = 1;
		$this->ParserState->save();
	}

	private function parseItems($array = [], $parent_id = null) {
		foreach ($array as $key => $item) {
			$_dom = new Dom;
			$this->loadDomFromUrl($item->getUrl(), $_dom);
			
			// Устанавливаем имя если его нет
			if (empty($item->getName())) {
				$name = $_dom->getElementById('pagetitle')->text;
				if (!empty($name)) {
					$item->setName($name);
				}
			}

			$base_obj = $this->saveCategory($item, $parent_id);

			// Смотрим подкатегории
			$_subcategories = $this->parseCategories($_dom, $base_obj->id);

			// Если подкатегорий нет, парсим товары, мы на конечке
			// Передаем текущий $_dom потому что страница без подкатегорий - это страница товаров
			if ($_subcategories) continue;
			$this->parseProducts($_dom, $item, $base_obj->id);

			$this->ParserState->cur_categories++;
			$this->ParserState->save();
		}
	}

	private function parseCategories($_dom, $parent_id) {
		$findCategories = false;
		$categories = $_dom->find('.section-compact-list__link');
		$this->ParserState->max_categories += $categories->count();
		$this->ParserState->max_save += $categories->count();
		$this->ParserState->save();
		$_subcategories = [];
		foreach ($categories as $category) {
			$findCategories = true;
			$_category = new Category($category->getAttribute('href'), BASE_URL);
			$text_el = $category->find('span', 0);
			if ($text_el->count() > 0) {
				$_category->setName($text_el->text);
			}
			$_subcategories[] = $_category;
			// $this->saveCategory($_category, $parent_id);
		}
		$this->parseItems($_subcategories, $parent_id);
		return $findCategories;
	}

	private function parseProducts($_dom_or_url, $parent, $parent_id) {
		// Если инстанс DOM, то парсим с него, иначе это URL, получаем DOM
		if ($_dom_or_url instanceof Dom) {
			$_dom = $_dom_or_url;
		} else {
			$_dom = new Dom;
			$this->loadDomFromUrl($_dom_or_url, $_dom);
		}
		
		// Получаем товары со страницы
		$products = $_dom->find('.wraps .table-view .item');
		$this->ParserState->max_products += $products->count();
		$this->ParserState->max_save += $products->count();
		$this->ParserState->save();
		foreach ($products as $product) {
			// Нам тут нужна только ссылка
			$tagA = $product->find('.item-info .item-title a');
			if ($tagA->count() > 0) {
				$tagA = $tagA[0];
				$this->parseProduct($tagA->getAttribute('href'), $parent_id);
			}
			$this->ParserState->cur_products++;
			$this->ParserState->save();
		}
	
		// Смотрим на кнопку ">" в пагинации, если существует,
		// то запускаем парсинг следующей страницы
		if ($_dom->find('.module-pagination a.flex-next')->count() == 0) return;

		$this->parseProducts($parent->getUrl(true), $parent, $parent_id);
	}

	private function parseProduct($url, $parent_id) {
		$product = new Product($url, BASE_URL);

		$_dom = new Dom;
		if (!$this->loadDomFromUrl($product->getUrl(), $_dom)) return;

		$product->setName($_dom->getElementById('pagetitle')->text);

		// Артикул
		$article = $_dom->find('span.article__value');
		if ($article->count() == 1) {
			$product->setArticle($article[0]->text);
		}

		// Поиск цены
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
			$product->setPrice($_price);
		}

		// Поиск наличия
		$store_el = $_dom->find('.product-side .store_view');
		if ($store_el->count() == 1) {
			$product->setStore($store_el[0]->text);
		}

		// Поиск изображений
		$images_el = $_dom->find('.product-detail-gallery__link');
		if ($images_el->count() > 0) {
			foreach ($images_el as $image_el) {
				$img_url = $image_el->getAttribute('href');
				if ($img_url == null) continue;
				$product->addImage($img_url);
			}
		}

		// Поиск описания
		$description_el = $_dom->find('#desc .content');
		if ($description_el->count() == 1) {
			$product->setDesc($description_el[0]->text);
		}
		
		// Поиск характеристик
		$char_el = $_dom->find('#props .props_list tr');
		if ($char_el->count() > 0) {
			foreach ($char_el as $char_cell) {
				$key_el = $char_cell->find('.char_name span');
				if ($key_el->count() <= 0) continue;
				$val_el = $char_cell->find('.char_value span');
				if ($val_el->count() <= 0) continue;

				$key = trim($key_el[0]->text);
				$val = trim($val_el[0]->text);
				$product->addChar($key, $val);
			}
		}

		// Поиск связанных товаров
		$chain_dom = new Dom();
		$chain_dom->loadStr($this->getChainFromRequest($product->getUrl()));
		$chain_el = $chain_dom->find('.items .item_block .item_info .item-title a');
		if ($chain_el->count() > 0) {
			foreach ($chain_el as $chain_a) {
				$url = $chain_a->getAttribute('href');
				if ($url == null) continue;
				$product->addChain($url);
			}
		}

		// Поиск бренда
		$brand_el = $_dom->find('.product-info-headnote__brand .brand .brand__picture');
		if ($brand_el->count() === 1) {
			$this->parseBrand($brand_el->getAttribute('href'));
		}		

		$this->saveProduct($product, $parent_id);
	}

	private function parseBrand($url) {
		$brand = new Brand($url, BASE_URL);
		if (in_array($brand->getUrl(), $this->BrandsBase)) return;
		$this->ParserState->max_brands++;
		$this->ParserState->cur_brands++;
		$this->ParserState->max_save++;
		$this->ParserState->save();

		$_dom = new Dom();
		$this->loadDomFromUrl($brand->getUrl(), $_dom);

		$brand->setName($_dom->getElementById('pagetitle')->text);

		$logo = $_dom->find('.detailimage .fancy > img');
		if ($logo->count() > 0) {
			$brand->setLogo($logo[0]->getAttribute('data-src'));
		}

		$desc = $_dom->find('.inner_wrapper_text .content-text > span');
		if ($desc->count() > 0) {
			$brand->setDesc($desc[0]->text);
		}

		$this->BrandsBase[] = $brand->getUrl();
		$this->saveBrand($brand);
	}

	private function getChainFromRequest($url) {
		$initial_opts = [
			CURLOPT_HEADER => false,
			CURLOPT_HTTPHEADER => [
				"x-requested-with: XMLHttpRequest",
			],
			CURLOPT_CONNECTTIMEOUT => 60,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => false,
		];

		$curl = curl_init($url.'?BLOCK=assoc');
		curl_setopt_array($curl, $initial_opts);
		$response = curl_exec($curl);
		curl_close($curl);

		return $response;
	}

	private function loadDomFromUrl($url, $dom, $retry = 0) {
		$initial_opts = [
			CURLOPT_HEADER => false,
			CURLOPT_HTTPHEADER => [],
			CURLOPT_CONNECTTIMEOUT => 60,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => false,
		];
		$curl = curl_init($url);
		curl_setopt_array($curl, $initial_opts);
		$response = curl_exec($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		if (!($httpCode >= 200 && $httpCode < 300 && !empty($response)) && $retry < 10) {
			if ($httpCode == 301) return false;
			echo $url."\n";
			echo $httpCode." ".(empty($response) ? 'empty' : $response)."\n";
			$retry++;
			sleep($retry);
			return $this->loadDomFromUrl($url, $dom, $retry);
		}

		$dom->loadStr($response);
		return true;
	}

	private function saveItems() {
		$this->recurciveSave($this->DataBase);
	}

	private function recurciveSave($els, $parent_id = false) {
		foreach ($els as $el) {
			if ($el instanceof Category) {
				$category = ParserItem::createCategory($el->getJustUrl(), $el->getName(), ($parent_id ? $parent_id : null));
				$this->recurciveSave($el->getItems(), $category->id);
				$this->ParserState->cur_save++;
				$this->ParserState->save();
				continue;
			}
			if ($el instanceof Product) {
				ParserItem::createProduct(
					$el->getUrl(),
					$el->getName(),
					$el->getDesc(),
					$el->getPrice(),
					$el->getStore(),
					$el->getImages(),
					$el->getChars(),
					$el->getChain(),
					$parent_id
				);
				$this->ParserState->cur_save++;
				$this->ParserState->save();
				continue;
			}
			if ($el instanceof Brand) {
				ParserItem::createBrand($el->getUrl(), $el->getName(), $el->getLogo(), $el->getDesc());
				$this->ParserState->cur_save++;
				$this->ParserState->save();
				continue;
			}
		}
	}

	private function saveCategory($el, $parent_id = null) {
		$category = ParserItem::createCategory($el->getJustUrl(), $el->getName(), ($parent_id ? $parent_id : null));
		// $this->recurciveSave($el->getItems(), $category->id);
		$this->ParserState->cur_save++;
		$this->ParserState->save();
		return $category;
	}

	private function saveProduct($el, $parent_id) {
		$product = ParserItem::createProduct(
			$el->getUrl(),
			$el->getName(),
			$el->getArticle(),
			$el->getDesc(),
			$el->getPrice(),
			$el->getStore(),
			$el->getImages(),
			$el->getChars(),
			$el->getChain(),
			$parent_id
		);
		$this->ParserState->cur_save++;
		$this->ParserState->save();
		return $product;
	}

	private function saveBrand($el) {
		$brand = ParserItem::createBrand($el->getUrl(), $el->getName(), $el->getLogo(), $el->getDesc());
		$this->ParserState->cur_save++;
		$this->ParserState->save();
		return $brand;
	}

}


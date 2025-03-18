<?php

namespace CSOnlineParserServiceClasses;

class Product {

	private  $url;
	protected $name;
	protected $price = 0;
	protected $store = 0;
	protected $images = [];
	protected $desc = '';
	protected $chars = [];
	protected $chain = [];
	protected $article = '';
	private $parent;
	protected $base_url;

	function __construct($url, $base_url) {
		$this->base_url = $base_url;
		$this->url = $this->base_url.$url;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setPrice($price) {
		$this->price = $price;
	}

	function setStore($text) {
		// Под заказ
		// Много
		// Достаточно
		// Мало
		switch (mb_strtolower($text)) {
			case 'много':
				$this->store = 3;
				break;

			case 'достаточно':
				$this->store = 2;
				break;

			case 'мало':
				$this->store = 1;
				break;

			case 'под заказ':
			default:
				$this->store = 0;
				break;
		}
	}

	function setParent($parent) {
		$this->parent = $parent;
	}

	function setDesc($desc) {
		$this->desc = $desc;
	}

	function setArticle($article) {
		$this->article = $article;
	}

	function addChar($key, $val) {
		$this->chars[$key] = $val;
	}

	function addChain($url) {
		array_push($this->chain, $this->base_url.$url);
	}

	function addImage($url) {
		array_push($this->images, $this->base_url.$url);
	}

	function getName() {
		return $this->name;
	}

	function getDesc() {
		return $this->desc;
	}

	function getUrl() {
		return $this->url;
	}

	function getPrice() {
		return $this->price;
	}

	function getStore() {
		return $this->store;
	}

	function getImages() {
		return $this->images;
	}

	function getChars() {
		return $this->chars;
	}

	function getChain() {
		return $this->chain;
	}

	function getArticle() {
		return $this->article;
	}

}

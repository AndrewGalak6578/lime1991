<?php

namespace CSOnlineParserServiceClasses;

class Url{

	public $url;
	private $category;
	private $product;

	function __construct($url, $category, $product) {
		$this->url = $url;
		$this->category = $category;
		$this->product = $product;
	}

}

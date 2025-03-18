<?php

namespace CSOnlineParserServiceClasses;

class Category {

	private $url;
	protected $name;
	private $items = [];
	private $urlParams = [
		'sort' => 'NAME',
		'order' => 'asc',
		'display' => 'table',
		'PAGEN_1' => 1,
	];
	private $parent;
	protected $base_url;

	function __construct($url, $base_url) {
		$this->base_url = $base_url;
		$this->url = $this->base_url.$url;
	}

	function setName($name) {
		$this->name = $name;
	}

	function getName() {
		return $this->name;
	}

	function setParent($parent) {
		$this->parent = $parent;
	}

	function addItem($item) {
		$this->items[] = $item;
	}

	function getItems() {
		return $this->items;
	}

	function getLastItem() {
		return end($this->items);
	}
	
	function getUrl($nextPage = false) {
		if ($nextPage) {
			$this->urlParams['PAGEN_1']++;
		}
		$params = $this->urlParams;
		if ($this->urlParams['PAGEN_1'] == 1) {
			unset($params['PAGEN_1']);
		}
		return implode('?', [$this->url, http_build_query($params)]);
	}

	function getJustUrl() {
		return $this->url;
	}

	function getPage() {
		return $this->urlParams['PAGEN_1'];
	}

}

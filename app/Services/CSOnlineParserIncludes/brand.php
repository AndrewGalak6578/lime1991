<?php

namespace CSOnlineParserServiceClasses;

class Brand{

	private $url;
	protected $logo = '';
	protected $name;
	protected $desc = '';
	protected $base_url;

	function __construct($url, $base_url) {
		$this->base_url = $base_url;
		$this->url = $this->base_url.$url;
	}

	function setLogo($url) {
		$this->logo = $this->base_url.$url;
	}

	function setName($name) {
		$this->name = $name;
	}

	function setDesc($desc) {
		$this->desc = $desc;
	}

	function getUrl() {
		return $this->url;
	}

	function getName() {
		return $this->name;
	}

	function getLogo() {
		return $this->logo;
	}

	function getDesc() {
		return $this->desc;
	}

}

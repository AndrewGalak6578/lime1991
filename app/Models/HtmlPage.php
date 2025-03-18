<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtmlPage extends Model
{
	use HasFactory;

	protected $guarded = ['id'];
	protected $casts = [
		'values' => 'array',
	];

	public static function setHtml($name, $content) {
		$page = HtmlPage::where('page', $name)->first();
		if (!$page) {
			$page = HtmlPage::create([
				'page' => $name,
				'html' => $content
			]);
		} else {
			$page->html = $content;
			$page->save();
		}

		return $page;
	}

	public static function setValues($name, $array) {
		$page = HtmlPage::where('page', $name)->first();
		if (!$page) {
			$page = HtmlPage::create([
				'page' => $name,
				'html' => '',
				'values' => $array
			]);
		} else {
			$page->values = array_merge($page->values, $array);;
			$page->save();
		}

		return $page;
	}

	public static function getHtml($name) {
		$page = HtmlPage::where('page', $name)->first();
		if (!$page) {
			$page = HtmlPage::create([
				'page' => $name,
				'html' => ''
			]);
		}

		return $page;
	}
}

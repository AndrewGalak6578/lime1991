<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentDeliveryController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('delivery');
		return view('front.content.delivery.index', [
			'page' => $page,
		]);
	}
}

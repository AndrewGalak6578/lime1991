<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentRefundController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('refund');
		return view('front.content.refund.index', [
			'page' => $page,
		]);
	}
}

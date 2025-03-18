<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentPaymentController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('payment');
		return view('front.content.payment.index', [
			'page' => $page,
		]);
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentPaymentController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('payment');
		return view('admin.content.payment.index', [
			'page' => $page,
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'content' => 'required|string',
		]);
		$page = HtmlPage::setHtml('payment', $request->input('content'));
		return view('admin.content.payment.index', [
			'page' => $page,
		]);
	}
}

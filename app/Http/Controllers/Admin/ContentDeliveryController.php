<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentDeliveryController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('delivery');
		return view('admin.content.delivery.index', [
			'page' => $page,
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'content' => 'required|string',
		]);
		$page = HtmlPage::setHtml('delivery', $request->input('content'));
		return view('admin.content.delivery.index', [
			'page' => $page,
		]);
	}
}

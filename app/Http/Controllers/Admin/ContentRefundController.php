<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentRefundController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('refund');
		return view('admin.content.refund.index', [
			'page' => $page,
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'content' => 'required|string',
		]);
		$page = HtmlPage::setHtml('refund', $request->input('content'));
		return view('admin.content.refund.index', [
			'page' => $page,
		]);
	}
}

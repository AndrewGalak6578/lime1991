<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentContactsController extends Controller
{
	public function index()
	{
		$page = HtmlPage::getHtml('contacts');
		return view('front.content.contacts.index', [
			'page' => $page,
		]);
	}
}

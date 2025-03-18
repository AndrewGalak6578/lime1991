<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\HtmlPage;

class ContentContactsController extends Controller
{

	public function index()
	{
		$page = HtmlPage::getHtml('contacts');
		return view('admin.content.contacts.index', [
			'page' => $page,
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'content' => 'required|string',
			'latitude' => 'required|string',
			'longitude' => 'required|string',
		]);
		$page = HtmlPage::setHtml('contacts', $request->input('content'));
		$page = HtmlPage::setValues('contacts', ['coordinates' => [$request->input('latitude'), $request->input('longitude')]]);
		return view('admin.content.contacts.index', [
			'page' => $page,
		]);
	}
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;

class BlogController extends Controller
{

	public function blog()
	{
		return view('admin.blog.index', [
			'articles' => Article::all()
		]);
	}

	public function article(Article $article, Request $request)
	{
		return view('admin.blog.article', [
			'article' => $article,
		]);
	}

	public function create()
	{
		return view('admin.blog.articles.create', [
			'articles' => Article::all()
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'content' => 'required|string',
			'name' => 'required|string',
		]);
		Article::create([
			'name' => $request->input('name'),
			'html' => $request->input('content'),
		]);
		return view('admin.blog.index', [
			'articles' => Article::all(),
		]);
	}

	public function edit(Article $article, Request $request)
	{
		return view('admin.blog.articles.edit', [
			'article' => $article,
		]);
	}

	public function update(Article $article, Request $request)
	{
		$request->validate([
			'content' => 'required|string',
			'name' => 'required|string',
		]);
		$article->update([
			'name' => $request->input('name'),
			'html' => $request->input('content'),
		]);
		flash('Обновлено!')->success();
		return back();
	}

	public function destroy(Article $article)
	{
		$article->delete();
		flash('Удалено!')->error();
		return back();
	}

}

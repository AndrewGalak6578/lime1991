<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;

class BlogController extends Controller
{

	public function blog()
	{
		return view('front.blog.index', [
			'articles' => Article::all()
		]);
	}

	public function article(Article $article, Request $request)
	{
		return view('front.blog.article', [
			'article' => $article,
		]);
	}

}

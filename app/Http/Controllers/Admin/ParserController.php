<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ParserItemsCategoryDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parser;
use App\Models\ParserItem;
// use App\Services\CSOnlineParserService;

// include dirname(realpath(__DIR__), 3).'/Services/CSOnlineParserService.php';

// exec("php Parser/background.php  > /dev/null 2> /dev/null &");

class ParserController extends Controller
{
	public function index()
	{
		$parser = Parser::latest()->first();
		if ($parser != null && !$parser->isComplete()) {
			return redirect(route('admin.parser.parsing'));
		}

		if (ParserItem::count() > 0) {
			return redirect(route('admin.parser.select.categories'));
		}

		return view('admin.parser.index');
	}

	public function parsing()
	{
		$parser = Parser::latest()->first();

		if (ParserItem::count() > 0 && ($parser == null || $parser->isComplete())) {
			return redirect(route('admin.parser.select.categories'));
		}

		if ($parser == null || $parser->isComplete()) {
			exec("php ".base_path()."/artisan parse:start >> ./parser_log 2>&1 &");
			sleep(2);
		}
		// print_r(base_path());
		return view('admin.parser.parsing');
	}

	public function progress()
	{
		$parser = Parser::latest()->first();
		return view('admin.parser.progress', [
			'progress' => ($parser != null ? $parser->getProgress() : null),
			'isComplete' => ($parser != null ? $parser->isComplete() : null),
			'time' => ($parser != null ? $parser->getTime() : null),
		]);
	}

	public function selectCategories(ParserItemsCategoryDataTable $dataTable)
	{
		$categories = ParserItem::where('type', 'category')->get();
		/* if(!$categories->isEmpty()) return view('admin.parser.selectCategories', [
			'items' => $categories,
		]); */
		if(!$categories->isEmpty()) return $dataTable->render('admin.parser.selectCategories');
		return redirect(route('admin.parser.select.products'));
	}

	public function selectProducts()
	{
		$products = ParserItem::where('type', 'category')->get();
		if(!$products->isEmpty()) return view('admin.parser.selectProducts', [
			'items' => $products,
		]);
		return redirect(route('admin.parser.select.brands'));
	}

	public function selectBrands()
	{
		return view('admin.parser.selectBrands');
	}

	public function cencelParser()
	{
		$parser = Parser::latest()->first();
		if ($parser != null && !$parser->isComplete()) {
			$parser->status = 1;
			$parser->save();
			exec("kill ".$parser->pid." > /dev/null 2> /dev/null &");
			// return redirect(route('admin.parser.parser'));
		}
		ParserItem::truncate();
		return redirect(route('admin.parser.parser'));
	}
}

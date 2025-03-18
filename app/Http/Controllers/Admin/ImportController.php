<?php

// Такой кринж, что тут происходит

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\Admin\FirstExcelImport;
use App\Imports\Admin\ExcelImport;
use App\Imports\Admin\ExcelChainsImport;

use App\Models\ProductCategory;
use App\Models\ImportExcelFile;

class ImportController extends Controller
{
	public function index()
	{
		return view('admin.products.imports.index', []);
	}

	public function upload(Request $request)
	{
		$path = $request['file']->store('excelImports');
		$file = ImportExcelFile::create([
			'path' => $path,
		]);

		if (isset($request['type'])) {
			switch ($request['type']) {
				case 'chains':
					return $this->chains($file);
					break;

				case 'products':
				default:
					$categories = ProductCategory::where('parent_id', '=', 0)->get();

					return view('admin.products.imports.category', [
						'categories' => $categories,
						'file_id' => $file->id,
					]);
					break;
			}
		}
	}

	public function category(Request $request)
	{
		$file = ImportExcelFile::where('id', $request['file_id'])->first();

		$elements = new FirstExcelImport();
		Excel::import($elements, $file->path);
		$elements = $elements->get();

		$category_chars = ProductCategory::where('id', $request['category'])->first()->chars->toArray();
		/* $similar_chars = [];
		foreach ($elements as $key => $element) {
			$percent = 0;
			$matchedTextKey = null;
			$textToMatch = mb_strtolower($element);
			foreach ($category_chars as $char_key => $char) {
				$_percent = 0;
				similar_text($textToMatch, mb_strtolower($char['name']), $_percent);
				if ($percent < $_percent) {
					$percent = $_percent;
					$matchedTextKey = $char_key;
				}
			}
			if ($matchedTextKey !== null && $percent > 80) {
				$similar_chars[$key] = [
					'id' => $category_chars[$matchedTextKey]['id'],
					'name' => $category_chars[$matchedTextKey]['name'],
				];
				// array_splice($category_chars, $matchedTextKey, 1);
			} else {
				$similar_chars[$key] = null;
			}
		} */

		return view('admin.products.imports.config', [
			'chars' => $elements,
			// 'similar_chars' => $similar_chars,
			'category_chars' => $category_chars,
			'category' => $request['category'],
			'file_id' => $request['file_id'],
		]);
	}

	public function importing(Request $request)
	{
		$file_id = $request['file_id'];	
		$category = $request['category'];	
		$fields = [
			'name' => null,
			'price' => null,
			'desc' => null,
			'photo' => null,
			'article' => null,
			'brand' => null,
		];
		$chars = [];

		$i = 0;
		while(isset($request['char:'.$i])) { // "char:[excel char N]" => [category char id]
			if ($request['char:'.$i] !== null) {
				$chars[$i] = (int) $request['char:'.$i];
			}
			$i++;
			if ($i > 100) {
				break;
			}
		}

		foreach (array_keys($fields) as $field_key) {
			if (isset($request['field_'.$field_key]) && !empty($request['field_'.$field_key])) {
				$fields[$field_key] = (int) $request['field_'.$field_key];
			}
		}

		$file = ImportExcelFile::where('id', $request['file_id'])->first();

		Excel::import($result = new ExcelImport([
			'category' => $category,
			'fields' => $fields,
			'chars' => $chars,
		]), $file->path);

		return view('admin.products.imports.list', [
			'list' => $result->getResult(),
		]);
	}

	public function chains($file)
	{
		Excel::import($result = new ExcelChainsImport(), $file->path);

		return view('admin.products.imports.chainedlist', [
			'list' => $result->getResult(),
		]);
	}

}

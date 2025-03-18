<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{

	public function upload(Request $request) {
		// Валидация файла
		$request->validate([
			'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);

		// Сохранение файла
		$path = $request->file('file')->store('images', 'public');

		// Возврат URL загруженного изображения
		return response()->json(['location' => Storage::url($path)]);
	}

}

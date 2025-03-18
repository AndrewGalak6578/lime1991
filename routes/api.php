<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/users', [\App\Http\Controllers\Api\UserController::class, 'index']);
Route::get('/tags', [\App\Http\Controllers\Api\ProductTagController::class, 'index']);
Route::get('/chars', [\App\Http\Controllers\Api\CharController::class, 'index']);
Route::get('/get-chars', [\App\Http\Controllers\Api\CharController::class, 'getChars']);
Route::get('/char/values/{char}', [\App\Http\Controllers\Api\CharController::class, 'getCharValues']);
Route::get('/brand/collections/{brand}', [\App\Http\Controllers\Api\BrandController::class, 'index']);


Route::get('categories', function(){
    return \App\Http\Resources\Api\ProductCategoryResource::collection(\App\Models\ProductCategory::all());
});


Route::get('homeCatalogs', function(){
   return \App\Http\Resources\Api\HomeCatalogResource::collection(\App\Models\HomeCatalog::all());
});
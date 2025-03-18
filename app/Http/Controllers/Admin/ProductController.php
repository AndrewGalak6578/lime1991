<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreProductRequest;
use App\Http\Requests\Admin\Update\UpdateProductRequest;
use App\Http\Resources\Admin\Products\ProductCategoryResource;
use App\Http\Resources\BrandCollectionResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductTagResource;
use App\Models\Brand;
use App\Models\BrandCollection;
use App\Models\Char;
use App\Models\CharGroup;
use App\Models\CharValue;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.products.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        dd(DB::table('chars')->where('category_id', 0)->select(['id', 'name', 'char_group_id'])->groupBy('char_group_id')->get());
        return view('admin.products.products.create', [
            'categories'=>ProductCategory::all(),
            'brands'=>Brand::all(),
            'charGroups'=>CharGroup::all(),
            'chars'=>Char::where('category_id', 0)->select(['id', 'name', 'char_group_id'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //Сохраняем полученные и проверенные данные в переменную
        $info = $request->validated();

        //Обрабатываем характеристики
        $db_chars = Char::whereIn('category_id', request()->get('categories'))->get();
        $product_chars = [];
        foreach($db_chars as $char){
            $char_value = $request->get('char_value_'.$char->id);
            if($char_value){
                if(!CharValue::where(['value'=>$char_value, 'char_id'=>$char->id])->exists()){
                    $char_value_db =  CharValue::create([
                        'value'=>$char_value,
                        'char_id'=>$char->id
                    ]);
                }else{
                    $char_value_db = CharValue::where(['value'=>$char_value, 'char_id'=>$char->id])->first();
                }
                array_push($product_chars, [
                    'id'=>$char_value_db->id,
                    'name'=>$char->name,
                    'value'=>$char_value_db->value
                ]);
            }
        }
        $info['chars'] = $product_chars;

        //Обрабатываем категории
        if($request->has('categories')){
            $db_categories = ProductCategory::whereIn('id', $request['categories'])->get();
            $product_categories = [];
            foreach($db_categories as $db_category)
            {
                array_push($product_categories, [
                    'id'=>$db_category->id,
                    'name'=>$db_category->name,
                    'parent_id'=>$db_category->parent_id
                ]);
            }
            $info['categories'] = $product_categories;
            $info['categories_ids'] = $request['categories'];
        }


        //Обрабатываем теги
        if($request->has('tags')){
            $db_tags = ProductTag::whereIn('id', $request['tags'])->get();
            $product_tags = [];
            foreach($db_tags as $db_tag){
                array_push($product_tags, [
                    'id'=>$db_tag->id,
                    'name'=>$db_tag->name,
                    'product_category_id'=>$db_tag->product_category_id
                ]);
            }
            $info['tags'] = $product_tags;
            $info['tags_ids'] = $request['tags'];
        }

//        dd($request->all());

        //Обрабатываем бренды
        if($request->has('brand_id') AND $request->get('brand_id') != 0){
            $db_brand = Brand::find($request['brand_id']);
            $info['brand'] = [
                'id'=>$db_brand->id,
                'name'=>$db_brand->name,
                'cover'=>$db_brand->cover
            ];
        }

        //Обрабатываем коллекции
        if($request->has('collection_id') AND $request->get('collection_id') != 0 AND BrandCollection::exists($request['collection_id'])){
            $db_collection = BrandCollection::find($request['collection_id']);
            $info['collection'] = [
                'id'=>$db_collection->id,
                'name'=>$db_collection->name,
                'brand_id'=>$db_collection->brand_id
            ];
        }

        $product = Product::create($info);

        //Обрабатываем обложку
        if($request->hasFile('cover')){
            $product->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        //Обрабатываем фотографии
        if($request->has('photos')){
            foreach($request['photos'] as $i => $photo){
                $product->addMediaFromRequest('photos['.$i.']')->toMediaCollection('photos');
            }
        }


        flash('Добавлено!')->success();
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.products.edit', [
            'product'=>$product,
            'categories'=>ProductCategory::all(),
            'brands'=>Brand::all(),
            'charGroups'=>CharGroup::all(),
            'chars'=>Char::where('category_id', 0)->select(['id', 'name', 'char_group_id'])->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //Сохраняем полученные и проверенные данные в переменную
        $info = $request->validated();

        //Обрабатываем характеристики
        $db_chars = Char::whereIn('category_id', request()->get('categories'))->get();
        $product_chars = [];
        foreach($db_chars as $char){

            $char_value = $request->get('char_value_'.$char->id);

            if($char_value){
                $char_value_db = CharValue::firstOrCreate(
                    ['value' => $char_value, 'char_id' => $char->id],
                    ['value' => $char_value, 'char_id' => $char->id]
                );
                array_push($product_chars, [
                    'id'=>$char_value_db->id,
                    'charId' => $char->id,
                    'name'=>$char->name,
                    'value'=>$char_value
                ]);

            }
        }

        $info['chars'] = $product_chars;

        //Обрабатываем категории
        $db_categories = ProductCategory::whereIn('id', $request['categories'])->get();
        $product_categories = [];
        foreach($db_categories as $db_category)
        {
            array_push($product_categories, [
                'id'=>$db_category->id,
                'name'=>$db_category->name,
                'parent_id'=>$db_category->parent_id
            ]);
        }
        $info['categories'] = $product_categories;
        $info['categories_ids'] = $request['categories'];

        //Обрабатываем теги
        if($request->has('tags')) {
            $db_tags = ProductTag::whereIn('id', $request['tags'])->get();
            $product_tags = [];
            foreach ($db_tags as $db_tag) {
                array_push($product_tags, [
                    'id' => $db_tag->id,
                    'name' => $db_tag->name,
                    'product_category_id' => $db_tag->product_category_id
                ]);
            }
            $info['tags'] = $product_tags;
            $info['tags_ids'] = $request['tags'];
        }

        //Обрабатываем бренды
        if($request->has('brand_id') && $request->get('brand_id')) {
            $db_brand = Brand::find($request['brand_id']);
            $info['brand'] = [
                'id' => $db_brand->id,
                'name' => $db_brand->name,
                'cover' => $db_brand->cover
            ];
        }


        //Обрабатываем коллекции
        $db_collection = BrandCollection::find($request['collection_id'] ?? 0);
        if($request->has('collection_id') AND $db_collection){
            $info['collection'] = [
                'id' => $db_collection->id,
                'name' => $db_collection->name,
                'brand_id' => $db_collection->brand_id
            ];
        }

        //Обрабатываем фотографии
        if($request->has('photos')){
            foreach($request['photos'] as $i => $photo){
                $product->addMediaFromRequest('photos['.$i.']')->toMediaCollection('photos');
            }
        }

        //Обрабатываем обложку
        if($request->hasFile('cover')){
            $product->addMediaFromRequest('cover')->toMediaCollection('cover');
        }

        $product->update($info);

        flash('Обновлено!')->success();
        return back();
    }

    public function addRelatedProduct(Request $request, Product $product)
    {
        $product->relatedProducts()->attach($request['product_id']);
        flash('Добавлено!')->success();
        return back();
    }

    public function removeRelatedProduct(Request $request, Product $product)
    {
        $product->relatedProducts()->detach($request['product_id']);
        flash('Удалено!')->info();
        return back();
    }

    public function attachChar(Request $request, Product $product)
    {
        $pr_chars = $product->chars;
        $char = Char::find($request['char_id']);
        $char_value = $request['value'];


        $charValue = CharValue::firstOrCreate(
            ['value' => $char_value, 'char_id' => $char->id],
            ['value' => $char_value, 'char_id' => $char->id]
        );


        array_push($pr_chars, [
            'id'=>$charValue->id,
            'charId' => $char->id,
            'name'=>$char->name,
            'value'=>$char_value
        ]);

        $product->update(['chars'=>$pr_chars]);

        flash('Добавлено!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->blocks()->detach();
        $product->relatedProducts()->detach();
        $product->delete();
        flash('Удалено!')->error();
        return back();
    }
}

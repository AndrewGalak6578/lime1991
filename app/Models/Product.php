<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\InteractsWithMedia;
use Nicolaslopezj\Searchable\SearchableTrait;



class Product extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia, SearchableTrait;
    use Filterable;

    protected $guarded = ['id'];

    protected $searchable = [
        'columns'=>[
            'products.name'=>10,
            'products.code'=>10,
        ],
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->singleFile();

        $this->addMediaCollection('photos');
    }

    protected $casts = [
        'brand' => 'array',
        'collection' => 'array',
        'categories_ids' => 'array',
        'categories' => 'array',
        'tags' => 'array',
        'tags_ids' => 'array',
        'chars' => 'array',
        'labels' => 'array',
        'cover' => 'array',
        'photos' => 'array'
    ];

    public function getBrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function getCollection()
    {
        return $this->hasOne(BrandCollection::class,'id', 'collection_id');
    }


    public function getCategoriesB(){
        $arr = $this->categories_ids;
        $cat = ProductCategory::find( end($arr));

       return $cat->breadcrumbs();
    }

    public function getCategories()
    {
        return ProductCategory::whereIn('id', $this->categories_ids)->orderBy('parent_id', 'DESC')->get();
    }

    public function getCategoriesTags()
    {
        return ProductTag::whereIn('product_category_id', $this->categories_ids)->get();
    }

    public function getCategoriesChars()
    {
        return Char::whereIn('category_id', $this->categories_ids)->get();
    }

    public function getTags()
    {
        return ProductTag::findMany($this->tags_ids);
    }

    public function hasCategory($id)
    {
        return in_array($id, $this->categories_ids);
    }

    public function hasTag($id)
    {
        return in_array($id, $this->tags_ids);
    }

    public function hasLabel($id)
    {
        return $this->labels != null && in_array($id, $this->labels);
    }

    public function getPrice()
    {
        $discount = (float)$this->promotion?->discount / 100;


        $price = preg_replace("/[^0-9]/", "", $this->price);
        $value = $price - ($price * $discount);
        return ceil($value);
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_related_products', 'product_id', 'related_product_id');
    }

    public function getCoverUrl()
    {
        return $this->getFirstMedia('cover') ? $this->getFirstMedia('cover')->getUrl() : '';
    }

    public function getCoverAlt()
    {
        return $this->name;
    }

    public function getPhotosAttribute()
    {
//        return $this->get
    }

    public function getMetaTitle()
    {
        return ($this->seo_title != null) ? $this->seo_title : $this->name;
    }

    public function getMetaDesc()
    {
        return ($this->seo_description != null) ? $this->seo_description : $this->name;
    }

    public function getBreadCrumbs()
    {
        return ($this->breadcrumb_name != null) ? $this->breadcrumb_name : $this->name;
    }

    public function block()
    {
        return $this->hasOne(ProductBlock::class, 'id', 'product_type');
    }

    public function isHidden()
    {
        return ($this->product_type == 1 OR $this->status == 5) ? true : false;
    }

    public function getStatusViewButton()
    {
        return view('front.products.parts.statusButton', ['status'=>$this->status]);
    }

    public function blocks()
    {
        return $this->belongsToMany(HomeProductBlock::class, 'homeproductblock_product', 'homeproductblock_id', 'product_id');
    }

    public function hasLengthVariation()
    {
        foreach([1, 12, 13, 14, 15] as $id){
            if(in_array($id, $this->categories_ids)){
                return true;
            }
        }
        return false;
    }

    public function blockProducts()
    {
        return $this->hasMany(BlockProduct::class, 'product_id', 'id');
    }

    public function blockProductsTwo()
    {
        return $this->belongsToMany(Product::class, 'block_products', 'product_id', 'related_product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function rating()
    {

        $ratings = $this->reviews()->pluck('rating')->toArray();
        $rating_values = [1, 2, 3, 4, 5];
        $ratings_count = count($ratings);

        $averageRating = array_sum($ratings) / count($ratings);
        $ratingCounts = array_count_values($ratings);


        $html = view('front.products.parts.average_rating', [
            'averageRating' => $averageRating
        ]);

        foreach ($rating_values as  $rating_value) {
            $rate = isset($ratingCounts[$rating_value]) ? $ratingCounts[$rating_value] : 0;
            $percent = $rate*100/$ratings_count;

            $html .= view('front.products.parts.rating', [
                'percent'=>$percent,
                'rating_value'=>$rating_value,
            ]);
        }

        return $html;
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

		public function getCategoriesAttribute()
    {
			$categories_data = ProductCategory::find($this->categories_ids[0]);
			return [$categories_data];
    }

		public function getBrandAttribute()
    {
			$brand_data = Brand::find($this->brand_id);
			return $brand_data;
    }

	public static function getFromCategory(int $id = 0) {
		if ($id === 0) {
			return Product::query();
		}
		$products = Product::query();
		$subCategories = ProductCategory::select(['id', 'parent_id'])->where('parent_id', $id)->get();
		foreach ($subCategories as $subCategory) {
			$products->orWhereJsonContains('categories_ids', $subCategory->id);
		}
		return $products;
	}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/* use App\Models\Brand;
use App\Models\Product; */

class ProductCategory extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ['id'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function parentCategory()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'parent_id');
    }


    public function subProductCategories()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id', 'id');
    }

    public function nestingOrder()
    {
        $i = 0;
        if($this->parent_id != 0){
            $i += 1;
            $i += $this->parentCategory->nestingOrder();
        }

        return $i;
    }

    public function getNestingOrderForSelect()
    {
        $r = '';
        for($i = 0; $i <= $this->nestingOrder(); $i++){
            $r .= '--';
        }
        return $r;
    }

    public function chars()
    {
        return $this->hasMany(Char::class, 'category_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(ProductTag::class, 'product_category_id', 'id');
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


    public function breadcrumbs()
    {
        $breadcrumbs = [];

        $category = $this;

        while ($category) {
            $breadcrumbs[] = $category;
            $category = $category->parentCategory;
        }

        return collect(array_reverse($breadcrumbs));
    }

    public function products()
    {
			$ids = $this->subProductCategories->pluck('id')->push($this->id);
			$products = Product::where(function ($query) use ($ids) {
				foreach ($ids as $id) {
					$query->orWhereJsonContains('categories_ids', $id);
				}
			})->orderByDesc('id');
			return $products;
    }

	public static function getFromBrand(Brand $brand) {
		$result = [];
		$categories = ProductCategory::select(['id', 'name', 'slug', 'icon', 'parent_id'])->where('parent_id', 0)->get();
		foreach ($categories as $category) {
			$result[] = [
				"count" => 0,
				"name" => $category->name,
				"id" => $category->id,
			];
			$key = array_key_last($result);
			$subCategories = ProductCategory::select(['id', 'name', 'slug', 'icon', 'parent_id'])->where('parent_id', $category->id)->get();
			foreach ($subCategories as $subCategory) {
				$products = Product::select(['id', 'brand_id', 'categories_ids'])->whereJsonContains('categories_ids', $subCategory->id)->where('brand_id', $brand->id)->get();
				$result[$key]['count'] += $products->count();
			}
		}
		return array_values(array_filter($result, function($value) {
      return $value['count'] != 0;
    }));
	}

	public static function getSubcategoryIds($id) {
		$result = [];
		$categories = ProductCategory::select(['id'])->where('parent_id', $id)->get();
		foreach ($categories as $category) {
			array_push($result, $category->id);
		}
		return $result;
	}
}

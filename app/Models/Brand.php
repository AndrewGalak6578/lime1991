<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Brand extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function getCoverUrl()
    {
        return ($this->cover != null) ? $this->cover : '/default-brand-cover.png';
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


    public function getLogoUrl()
    {
				return $this->getFirstMedia('logo') ? $this->getFirstMedia('logo')->getUrl() : '';
        // return $this->logo;
    }

    public function collections()
    {
        return $this->hasMany(BrandCollection::class, 'brand_id', 'id');
    }

	public function getCategories()
	{
		return ProductCategory::getFromBrand($this);
	}
}

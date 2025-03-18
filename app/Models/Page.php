<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ['id'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function keyValues()
    {
        return $this->hasMany(PageKeyValue::class, 'page_id', 'id');
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
}

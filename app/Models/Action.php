<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Action extends Model
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
    public function brands()
    {
        return $this->hasMany(ActionBrand::class, 'action_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'action_brand_product', 'action_brand_id', 'product_id');
    }
}

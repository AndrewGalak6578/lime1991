<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Char extends Model
{
    use HasFactory, HasSlug;

    protected $guarded = ['id'];

    #Генерируем slug
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    #Категория к которой принадлежит характеристика
    public function category()
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    #Значения характеристики
    public function values()
    {
        return $this->hasMany(CharValue::class, 'char_id', 'id');
    }

    #группа характеристики
    public function group()
    {
        return $this->hasOne(CharGroup::class, 'id', 'char_group_id');
    }

}



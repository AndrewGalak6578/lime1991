<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
	use HasFactory, HasSlug;

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

}

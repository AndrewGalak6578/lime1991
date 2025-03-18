<?php

namespace App\Models;

use App\Models\Scopes\ActiveStatusScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Promotion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = ['id'];

//    protected $casts = ['available_until' => 'datetime'];

    protected static function booted()
    {
        if (request()->route()->getPrefix() == '/admin') return;
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('available_until', ">", now())->where('status', 1);
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }
}

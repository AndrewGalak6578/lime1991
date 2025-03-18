<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'slug'=>$this->slug,
            'cover'=>$this->cover,
            'cover_2'=>$this->cover_2,
            'icon'=>$this->icon,
            'description'=>$this->description,
            'description_2'=>$this->description_2,
            'parent_id'=>$this->parent_id,
            'seo_title'=>$this->seo_title,
            'seo_description'=>$this->seo_description,
            'breadcrumb_name'=>$this->breadcrumb_name,
            'status'=>$this->status
        ];
    }
}

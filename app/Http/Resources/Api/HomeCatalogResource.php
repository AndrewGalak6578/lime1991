<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeCatalogResource extends JsonResource
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
            'description'=>$this->description,
            'bg'=>$this->bg,
            'icon'=>$this->icon,
            'link'=>$this->link,
            'position'=>$this->position,
        ];
    }
}

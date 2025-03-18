<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BrandCollectionResource;
use App\Http\Resources\Api\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Brand $brand)
    {
        return BrandCollectionResource::collection($brand->collections()->get());
    }
}

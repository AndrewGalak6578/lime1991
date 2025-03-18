<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function show(Promotion $promotion){

       return view('front.promotion.show', compact('promotion'));
    }
}

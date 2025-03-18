<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function interaction(Request $request)
    {
        auth()->user()->products()->syncWithoutDetaching($request['product_id']);
        return response('added', 200);
    }

    public function destroy($product_id)
    {
        auth()->user()->products()->detach($product_id);
        return response('removed', 200);
    }
}

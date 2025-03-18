<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\Store\StoreReviewRequest;
use App\Http\Requests\Admin\Update\UpdateReviewRequest;
use App\Models\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $info = $request->validated();
        $info['user_id'] = auth()->id();
        Review::create($info);
        flash('Ваш отзыв отправлен на модерацию')->success();
        //TODO отправить EMAIL пользователю и админу
        return back();
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        flash('Ваш отзыв удален!')->error();
        return back();
    }
}

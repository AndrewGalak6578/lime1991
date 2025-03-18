<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Jobs\LoadPhotoJob;
use App\Models\HomeCatalog;
use App\Models\HomeProductBlock;
use App\Models\HomeSlide;
use App\Models\Page;
use App\Models\PageKeyValue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FrontController extends Controller
{
    public function index()
    {
        // $data = Excel::toArray(null, '2786370--aquatek-rf.ru.csv')[0];
        // unset($data[0]);

        // foreach ($data as $datum) {
        //     dispatch(new LoadPhotoJob($datum));
        // }
        $page = Page::find(1);
        return view('front.index', [
            'page'=>$page,
            'catalogs'=>HomeCatalog::select(['name', 'description', 'bg', 'link', 'icon', 'position'])->orderBy('position')->get(),
            'homeSliders'=>HomeSlide::select(['web_img', 'mobile_img', 'alt', 'link', 'position'])->orderBy('position')->get(),
            'keyValues'=>$page->keyValues()->get(),
            'blocks'=>HomeProductBlock::all()
        ]);
    }


}

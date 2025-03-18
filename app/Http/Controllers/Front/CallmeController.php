<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Callme;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class CallmeController extends Controller
{
    public function store(Request $request)
    {
        $info = $this->validate($request, [
            'phone'=>'required',
            'page_name'=>'required',
            'page_url'=>'required'
        ]);

        $callme = Callme::create($info);


        $message = null;
        $message .= view('admin.callmes.message', [
            'callme'=>$callme
        ]);


        TelegramService::sendMessage($message);


        return response('ok', 200);
    }
}

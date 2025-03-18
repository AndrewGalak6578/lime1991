<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService {


    public static function sendMessage($message)
    {
        $url =  "https://api.telegram.org/bot".env('TELEGRAM_BOT_API')."/sendMessage";

        Http::withQueryParameters([
            'chat_id'=>env('TELEGRAM_BOT_CHAT_ID'),
            "text"=>$message,
            "parse_mode"=>"HTML"
        ])->post($url);

    }

}

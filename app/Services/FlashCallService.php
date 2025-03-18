<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FlashCallService {

	public static function call($number)
	{
		$url =  "https://api.telegram.org/bot".env('TELEGRAM_BOT_API')."/sendMessage";

		Http::withQueryParameters([
			'chat_id'=>env('TELEGRAM_BOT_CHAT_ID'),
			"parse_mode"=>"HTML"
		])->post($url);
	}

}

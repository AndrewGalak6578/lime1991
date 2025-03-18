<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ParserItemToBase;

class ParserUploadCommand extends Command
{
	protected $signature = 'parser:upload';
	protected $description = 'Загрузка данных парсеров в основные таблицы';

	public function handle()
	{
		$script = new ParserItemToBase();
		$script->upload();
	}
}

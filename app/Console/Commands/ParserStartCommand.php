<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Parser;
use App\Services\CSOnlineParserService;

class ParserStartCommand extends Command
{
    protected $signature = 'parser:start';
    protected $description = 'Запуск парсера';

    public function handle()
    {
			$parser = Parser::latest()->first();
			if ($parser == null || $parser->isComplete()) {
				$parsing = new CSOnlineParserService();
				$parsing->parse();
				return true;
			}
			return false;
    }
}

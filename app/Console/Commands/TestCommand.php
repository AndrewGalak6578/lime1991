<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class TestCommand extends Command
{
	protected $signature = 'test';
	protected $description = '~';

	public function handle()
	{
		while (1) {
			try {
				$newProduct = new Product();
				$_image = $newProduct->addMediaFromUrl('https://cs-online.su/catalog/filtry_dlya_vody/komplektuyushchie/93362/	');
				$_image->toMediaCollection('cover');
			} catch (\Exception $e) {
				echo "e\n";
			}
			sleep(100);
		}
	}
}

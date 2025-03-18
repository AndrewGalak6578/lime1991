<?php

namespace App\Imports\Admin;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithLimit;

use App\Models\Product;

class ExcelChainsImport implements ToArray, WithChunkReading, WithStartRow, SkipsEmptyRows/*, WithLimit*/
{
	private $addedProducts = [];
	private $skippedProducts = [];

	public function __construct()
	{
	}

	public function array(array $array)
	{
		foreach ($array as $el) {
			$articul = $el[0];
			$chain = $el[1];
			$chainEls = explode(';', $chain);
			
			$product = Product::where('code', $articul)->first();
			if ($product) {
				$chained = [];
				$skipped = [];
				foreach ($chainEls as $chainEl) {
					$chain_product = Product::where('code', $chainEl)->first();
					if ($chain_product) {
						$product->relatedProducts()->attach($chain_product->id);
						array_push($chained, $chainEl);
					} else {
						array_push($skipped, $chainEl);
					}
				}
				array_push($this->addedProducts, [
					$articul,
					$chained,
					$skipped,
				]);
			} else {
				array_push($this->skippedProducts, $articul);
			}
		}

		return true;
	}

	public function getResult()
	{
		return [$this->addedProducts, $this->skippedProducts];
	}

	public function startRow(): int
	{
		return 2;
	}

	/* public function limit(): int
	{
		return 2;
	} */

	public function chunkSize(): int
	{
		// return 5000;
		return 1000;
	}
}

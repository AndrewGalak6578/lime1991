<?php

namespace App\Imports\Admin;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class FirstExcelImport implements ToArray, WithLimit, WithChunkReading, SkipsEmptyRows
{

	private $data = [];

	public function array(array $array)
	{
		$this->data = (count($array) >= 1 ? $array[0] : []);
	}

	public function get()
	{
		return $this->data;
	}

	public function limit(): int
	{
		return 1;
	}

	public function chunkSize(): int
	{
		return 1;
	}
}

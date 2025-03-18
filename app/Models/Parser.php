<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parser extends Model
{
  use HasFactory;

	protected $guarded = ['id'];

	private function getProgressPairs() {
		return [
			[$this->cur_categories, $this->max_categories, 'Собираем категории'],
			[$this->cur_products, $this->max_products, 'Собираем товары'],
			[$this->cur_brands, $this->max_brands, 'Собираем бренды'],
			[$this->cur_save, $this->max_save, 'Сохраняем результат'],
		];
	}

	public function isComplete() {
		/* foreach ($this->getProgressPairs() as $pair) {
			if ($pair[0] !== $pair[1]) {
				return false;
			}
		}
		return true; */
		return ($this->status == 0 ? false : true);
	}

	public function getProgress() {
		$items = [];
		foreach ($this->getProgressPairs() as $pair) {
			// $items[] = [$pair[2], ceil($pair[0] / ($pair[1] / 100)), $pair[0], $pair[1]];
			$items[] = [$pair[2], $pair[0], $pair[1]];
		}
		return $items;
	}

	public function getTime() {
		$seconds = time() - strtotime($this->created_at);
		$hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $remainingSeconds = $seconds % 60;

    return sprintf("%02d:%02d:%02d", $hours, $minutes, $remainingSeconds);
	}
}

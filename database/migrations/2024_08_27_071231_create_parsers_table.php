<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('parsers', function (Blueprint $table) {
			$table->id();
			/*
			 * Префиксы:
			 * cur_ - текущая метка
			 * max_ - максимальное значение метки
			 */
      $table->integer('cur_categories')->default(0);
      $table->integer('max_categories')->default(0);
      $table->integer('cur_products')->default(0);
      $table->integer('max_products')->default(0);
      $table->integer('cur_brands')->default(0);
      $table->integer('max_brands')->default(0);
      $table->integer('cur_save')->default(0);
      $table->integer('max_save')->default(0);
			// 0 - запущен, 1 - завершен
      $table->integer('status')->default(0);
      $table->integer('pid')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('parsers');
	}
};

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
		Schema::create('parser_items', function (Blueprint $table) {
			$table->id();
			/**
			 * Типы:
			 * category
			 * product
			 * brand
			 */
      $table->string('type');
			// Все типы
      $table->text('url');
      $table->text('name');

			// Только brand
      $table->string('logo_url')->default('');

			// Только brand и product
      $table->text('desc')->default('');

			// Только product
      $table->integer('price')->default(0);
      $table->integer('store')->default(0);
      $table->json('images')->default(json_encode([], JSON_UNESCAPED_UNICODE));
      $table->json('chars')->default(json_encode([], JSON_UNESCAPED_UNICODE));
      $table->json('chain')->default(json_encode([], JSON_UNESCAPED_UNICODE));
      $table->text('article')->nullable();

			// Только product и category
      $table->integer('category')->nullable();

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('parser_items');
	}
};

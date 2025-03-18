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
			Schema::table('html_pages', function (Blueprint $table) {
        $table->string('values')->default(json_encode([]));
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
			Schema::table('html_pages', function (Blueprint $table) {
      	$table->dropColumn('values');
			});
    }
};

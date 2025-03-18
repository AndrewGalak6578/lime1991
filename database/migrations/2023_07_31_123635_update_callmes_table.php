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
        Schema::table('callmes', function (Blueprint $table) {
            $table->dropColumn('from_where');
            $table->string('page_name', 2000)->nullable();
            $table->string('page_url', 2000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('callmes', function (Blueprint $table) {
            $table->dropColumn('page_name');
            $table->dropColumn('page_url');
        });
    }
};

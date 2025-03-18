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
        Schema::create('chars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('char_group_id')->default(0);
            $table->integer('show_in_filter')->default(1);
            $table->string('seo_title', 500)->nullable();
            $table->string('seo_description', 500)->nullable();
            $table->string('breadcrumb_name', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chars');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 2000);
            $table->string('slug')->unique();
            $table->string('code')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->default(1);
            $table->longText('description')->nullable();
            $table->integer('brand_id')->default(0);
            $table->json('brand')->nullable();
            $table->integer('collection_id')->default(0);
            $table->json('collection')->nullable();
            $table->json('categories_ids')->nullable();
            $table->json('categories')->nullable();
            $table->json('tags')->nullable();
            $table->json('tags_ids')->nullable();
            $table->json('chars')->nullable();
            $table->json('labels')->nullable();
            $table->json('cover')->nullable();
            $table->json('photos')->nullable();
            $table->string('seo_title', 500)->nullable();
            $table->string('seo_description', 500)->nullable();
            $table->string('breadcrumb_name', 500)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

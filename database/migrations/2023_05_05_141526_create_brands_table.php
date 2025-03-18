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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_2')->nullable();
            $table->string('website')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_2')->nullable();
            $table->longText('description_3')->nullable();
            $table->string('seo_title', 500)->nullable();
            $table->string('seo_description', 500)->nullable();
            $table->string('breadcrumb_name', 500)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};

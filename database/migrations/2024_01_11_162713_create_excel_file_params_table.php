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
        Schema::create('excel_file_params', function (Blueprint $table) {
            $table->id();
            $table->integer('excel_file_id');
            $table->string('param');
            $table->string('column');
            $table->string('default_amount')->nullable();
            $table->boolean('mm_to_cm')->default(false);
            $table->boolean('change_value')->default(false);
            $table->boolean('skip_new_values')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_file_params');
    }
};

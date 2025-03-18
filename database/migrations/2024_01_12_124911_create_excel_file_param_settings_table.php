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
        Schema::create('excel_file_param_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('excel_file_param_id');
            $table->integer('char_value_id');
            $table->text('excel_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_file_param_settings');
    }
};

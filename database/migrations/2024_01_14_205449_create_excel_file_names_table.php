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
        Schema::create('excel_file_names', function (Blueprint $table) {
            $table->id();
            $table->integer('excel_file_id');
            $table->integer('type')->default(0); //0-free text, any-another- param
            $table->integer('excel_file_param_id')->default(0);
            $table->string('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_file_names');
    }
};

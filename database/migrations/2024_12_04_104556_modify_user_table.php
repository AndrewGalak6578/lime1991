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
			Schema::table('users', function (Blueprint $table) {
				$table->dropUnique('users_email_unique');
				$table->string('phone')->nullable(false)->unique()->change();
        $table->string('email')->nullable()->change();
        $table->string('name')->nullable()->change();
        $table->string('password')->nullable()->change();
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
			Schema::table('users', function (Blueprint $table) {
				$table->dropUnique('users_phone_unique');
				$table->string('phone')->nullable()->change();
        $table->string('email')->nullable(false)->unique()->change();
        $table->string('name')->nullable(false)->change();
        $table->string('password')->nullable(false)->change();
			});
    }
};

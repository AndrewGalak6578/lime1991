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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('type')->default(0); //0-в процентах, 1-фикс, 2-бесплатная доставка
            $table->string('coupon_amount');
            $table->integer('users_amount')->default(0); //0-всем, 1-конкретный пользователь, 2-опр.количеству
            $table->integer('user_id')->default(0);
            $table->dateTime('available_until')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};

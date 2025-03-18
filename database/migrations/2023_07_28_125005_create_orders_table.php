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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->integer('delivery_method')->default(1); //1-доставка 2-самовывоз
            $table->integer('user_address_id')->default(0);
            $table->string('full_address', 3000)->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('address_comment', 1200)->nullable();
            $table->string('delivery_price')->default(0);

            $table->string('last_name');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->string('amount')->nullable();

            $table->integer('payment_method')->default(1); //1-нал, 2-картой, 3-онлайн
            $table->integer('status')->default(0); //0-заказ создан, 1-на сборке, 2-на доставке, 3-отмене, 4-завершен, 5-ожидает оплату, 6-ошибка оплаты
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

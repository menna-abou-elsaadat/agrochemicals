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
            $table->unsignedBigInteger('user_id');
            $table->longText('shipping_address');
            $table->longText('shipping_governorate');
            $table->longText('payment_type');
            $table->longText('phone');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->double('total_price');
            $table->double('shipping_fees');
            $table->double('discount')->default(0);
            $table->double('final_price')->default(0);
            $table->string('order_status')->default('معلق');
            $table->string('payment_status')->default('لم يتم الدفع');
            $table->date('purchase_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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

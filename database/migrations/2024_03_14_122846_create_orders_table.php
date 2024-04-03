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
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->float('total_price');
            $table->float('shipping_fees');
            $table->string('order_status')->default('معلق');
            $table->string('payment_status')->default('لم يتم الدفع');
            $table->date('purchase_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
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

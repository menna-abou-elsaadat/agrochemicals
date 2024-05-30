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
        Schema::create('dieses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_product_id');
            $table->longText('crop');
            $table->longText('dieses');
            $table->longText('hse_precuations')->nullable();
            $table->longText('phi')->nullable();
            $table->timestamps();
            $table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dieses');
    }
};

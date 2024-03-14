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
        Schema::create('category_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('secondary_name')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('file_id')->nullable();
            $table->float('price')->default(0);
            $table->float('cost')->default(0);
            $table->float('discount')->default(0);
            $table->integer('special')->default(0);
            $table->integer('stock')->default(0);
            $table->longText('active_material')->nullable();
            $table->longText('properties')->nullable();
            $table->longText('recommended_doses')->nullable();
            $table->longText('hse_precuations')->nullable();
            $table->longText('other_data')->nullable();
            $table->string('origin_country')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_products');
    }
};

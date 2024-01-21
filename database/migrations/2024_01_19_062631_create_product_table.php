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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->string('description');
            $table->string('feature_image_url') ;
            $table->string('gallery_image_url');
            $table->float('shipping_cost');
            $table->unsignedBigInteger('product_status_id');
            $table->unsignedBigInteger('created_by_user_id')->unsig;
            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('product_status_id')->references('id')->on('product_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

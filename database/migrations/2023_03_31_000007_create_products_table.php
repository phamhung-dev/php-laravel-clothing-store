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
            $table->increments('id');
            $table->string('name', 256)->unique();
            $table->mediumText('image');
            $table->mediumText('image_hover');
            $table->string('description', 512);
            $table->boolean('gender');
            $table->string('weight', 32);
            $table->string('dimensions', 128);
            $table->string('materials', 512);
            $table->string('other_info', 512)->nullable();
            $table->decimal('import_price', $precision = 10, $scale = 0);
            $table->decimal('sell_price', $precision = 10, $scale = 0);
            $table->tinyInteger('discount_percent');
            $table->unsignedInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onUpdate('cascade');
            $table->boolean('is_active');
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

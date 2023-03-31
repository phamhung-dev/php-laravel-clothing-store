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
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedInteger('product_inventory_id');
            $table->foreign('product_inventory_id')->references('id')->on('product_inventories')->onUpdate('cascade');
            $table->unsignedInteger('order_detail_id');
            $table->foreign('order_detail_id')->references('id')->on('order_details')->onUpdate('cascade');
            $table->primary(['product_inventory_id', 'order_detail_id']);
            $table->decimal('price', $precision = 10, $scale = 0);
            $table->tinyInteger('discount_percent');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

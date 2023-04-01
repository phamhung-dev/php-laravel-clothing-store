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
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->decimal('subtotal', $precision = 10, $scale = 0);
            $table->decimal('total', $precision = 10, $scale = 0);
            $table->unsignedInteger('coupon_id')->nullable();;
            $table->foreign('coupon_id')->references('id')->on('coupons')->onUpdate('cascade');
            $table->unsignedInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payments')->onUpdate('cascade');
            $table->string('note', 512)->nullable();;
            $table->string('apartment_number', 256);
            $table->string('street', 256);
            $table->string('ward', 256);
            $table->string('district', 256);
            $table->string('city', 256);
            $table->string('telephone', 10);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

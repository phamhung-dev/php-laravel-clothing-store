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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 256);
            $table->string('last_name', 256);
            $table->mediumText('avatar');
            $table->string('email', 256)->unique();
            $table->string('password', 512);
            $table->date('birthdate');
            $table->boolean('gender');
            $table->string('telephone', 10)->unique();
            $table->string('apartment_number', 256);
            $table->string('street', 256);
            $table->string('ward', 256);
            $table->string('district', 256);
            $table->string('city', 256);
            $table->boolean('receive_newsletter');
            $table->boolean('receive_offers');
            $table->boolean('is_locked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

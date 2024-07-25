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
            $table->integer('user_id')->nullable();
            $table->string('phone'); // Change the data type to string
            $table->longText('address');
            $table->string('user_name');
            $table->string('smile_gift')->nullable();
            $table->string('theme')->nullable();
            $table->longText('wish')->nullable();
            $table->longText('message')->nullable();
            $table->string('product_name');
            $table->string('image');
            $table->integer('status');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total');
            $table->string('orderCode');
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

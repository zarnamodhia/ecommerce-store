<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
       Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->text('shipping_address');
    $table->string('payment_method')->default('COD'); // COD or Razorpay
    $table->string('status')->default('Pending'); // Pending, Shipped, Delivered
    $table->decimal('total_amount', 10, 2);
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

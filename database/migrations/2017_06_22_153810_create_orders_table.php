<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orderId');
            $table->string('email');
            $table->string('cname');
            $table->string('city');
            $table->date('orderDate');
            $table->time('orderTime');
            $table->integer('amount');
            $table->string('orderType');
            $table->integer('restaurantId');
            $table->string('restaurantTitle');
            $table->integer('branchCode');
            $table->string('branchArea');
            $table->string('orderStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

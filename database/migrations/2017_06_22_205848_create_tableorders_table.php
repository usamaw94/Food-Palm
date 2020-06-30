<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableorders', function (Blueprint $table) {
            $table->increments('tableId');
            $table->integer('restaurantId');
            $table->integer('branchCode');
            $table->string('restaurantTitle');
            $table->string('branchArea');
            $table->string('tableStatus');
            $table->integer('numOfPersons');
            $table->time('reservationTime');
            $table->date('reservationDate');
            $table->string('cname');
            $table->string('email');
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
        Schema::dropIfExists('tableorders');
    }
}

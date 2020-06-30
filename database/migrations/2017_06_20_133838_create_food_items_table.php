<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_items', function (Blueprint $table) {
            $table->increments('itemId');
            $table->string('itemName');
            $table->string('description');
            $table->integer('restaurantId');
            $table->string('imageSource');
            $table->string('imageName');
            $table->string('subCategoryId');
            $table->string('categoryId');
            $table->integer('price');
            $table->string('combo');
            $table->integer('discount');
            $table->string('comboCheck');
            $table->string('comboPrice');
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
        Schema::dropIfExists('food_items');
    }
}

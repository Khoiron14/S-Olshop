<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->string('name');
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock');
            $table->timestamps();
        });

        Schema::create('category_item', function (Blueprint $table) {
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('item_id');
            $table->primary(['category_id', 'item_id']);
        });

        Schema::create('image_item', function (Blueprint $table) {
            $table->unsignedInteger('item_id');
            $table->string('name');
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
        Schema::dropIfExists('items');
        Schema::dropIfExists('category_item');
        Schema::dropIfExists('image_item');
    }
}

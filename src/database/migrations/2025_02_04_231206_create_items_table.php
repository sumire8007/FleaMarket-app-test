<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignID('user_id')->constrained();
            $table->foreignID('category_id')->constrained();
            $table->foreignID('condition_id')->constrained();
            $table->string('item_name');
            $table->string('price');
            $table->text('detail');
            $table->string('brand')->nullable();
            $table->string('item_img');
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
    }
}

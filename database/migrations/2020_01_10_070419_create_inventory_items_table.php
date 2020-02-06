<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->string('size');
            $table->string('size_unit');
            $table->text('description')->nullable();
            $table->string('brand'); // pireri, mrf,
            $table->decimal('price');
            $table->integer('quantity');
            $table->integer('minimum_quantity');
            // $table->boolean('saleable')->default(1);
            $table->timestamps();

            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}

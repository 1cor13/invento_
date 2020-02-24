<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedBigInteger('customer_id')->index();

            $table->string('subtotal')->default(0);
            $table->unsignedDecimal('discount')->default(0); // TODO: To be discussed
            $table->unsignedDecimal('fees')->default(0); // TODO: To be discussed
            $table->unsignedDecimal('taxes')->default(0); // TODO: To be discussed
            $table->double('totalcost')->default(0);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
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

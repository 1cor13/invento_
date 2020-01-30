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
            $table->unsignedInteger('user_id');

            $table->string('customername');
            $table->string('customeraddress')->nullable();
            $table->string('customerphone')->nullable();
            $table->string('customeremail')->nullable();
            $table->string('orderItem'); // 'inventoryItem' from order-inventoryitems many-to-many association (an order can have many InventoryItems)
            $table->string('subtotal');
            $table->unsignedDecimal('discount'); // TODO: To be discussed
            $table->unsignedDecimal('fees'); // TODO: To be discussed
            $table->unsignedDecimal('taxes'); // TODO: To be discussed
            $table->text('notes')->nullable();

            $table->double('totalcost');
            $table->timestamps();
            $table->index('user_id');
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

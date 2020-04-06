<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Order::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // DB::table('orders')->delete();
        factory(Order::class)->create();
    }
}

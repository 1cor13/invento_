<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Item::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('items')->delete();
        factory(Item::class, 50)->create();
    }
}

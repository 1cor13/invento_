<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Customer::truncate();
        Schema::enableForeignKeyConstraints();
        
        factory(\App\Customer::class, 3)->create();
    }
}
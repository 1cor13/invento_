<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Role::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;')

        DB::table('roles')->delete();
        Role::create(['name' => 'admin']); // id = 1
        Role::create(['name' => 'manager']); // id = 2
        Role::create(['name' => 'dataentrant']); // id = 3
    }
}

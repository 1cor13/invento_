<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\ItemOrderPivot;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        ItemOrderPivot::truncate();
        Schema::enableForeignKeyConstraints();

        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // User::truncate();

        // DB::table('users')->delete();
        // DB::table('role_user')->delete();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $dataEntryRole = Role::where('name', 'dataentrant')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@invento.test',
            'password' => Hash::make('password')
        ]);

        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@invent.test',
            'password' => Hash::make('password')
        ]);

        $dataEntrant = User::create([
            'name' => 'Data Entrant',
            'email' => 'dataentrant@invento.test',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $dataEntrant->roles()->attach($dataEntryRole);
    }
}

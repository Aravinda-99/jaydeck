<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class DefaultLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123123'),
            'email' => 'admin@sense.com',
        ]);

        $role = Role::create([ 'title' => 'Admin']);

        $user->roles()->attach($role);

        $client = User::create([
            'name' => 'user',
            'username' => 'user',
            'password' => bcrypt('123123'),
            'email' => 'user@sense.com',
        ]);

        $client->roles()->attach($role);
    }
}

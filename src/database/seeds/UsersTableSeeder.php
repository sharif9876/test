<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1821)->create();

        App\User::create([
            'name' => 'Oshi Okomilo',
            'email' => 'oshi@guestlist.net',
            'email_verified_at' => now(),
            'level' => 2,
            'points' => 74,
            'password' => Hash::make('password'),
            'userlevel' => 'owner',
            'remember_token' => str_random(10)
        ]);
    }
}

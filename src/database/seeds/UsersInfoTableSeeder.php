<?php

use Illuminate\Database\Seeder;

class UsersInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UserInfo::create([
            'info' => 'yes',
            'user_id' => '3',
            'question_id' => '1'
        ]);
        App\UserInfo::create([
            'info' => 'no',
            'user_id' => '19',
            'question_id' => '1'
        ]);
        App\UserInfo::create([
            'info' => 'yes',
            'user_id' => '7',
            'question_id' => '1'
        ]);
        App\UserInfo::create([
            'info' => 'gin',
            'user_id' => '3',
            'question_id' => '2'
        ]);
        App\UserInfo::create([
            'info' => 'beer',
            'user_id' => '7',
            'question_id' => '2'
        ]);
    }
}

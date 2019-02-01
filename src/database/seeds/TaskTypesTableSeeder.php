<?php

use Illuminate\Database\Seeder;

class TaskTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\TaskType::create([
            'name' => 'image'
        ]);
        App\TaskType::create([
            'name' => 'select'
        ]);
        App\TaskType::create([
            'name' => 'multiple'
        ]);
        App\TaskType::create([
            'name' => 'num'
        ]);
        App\TaskType::create([
            'name' => 'date'
        ]);
    }
}

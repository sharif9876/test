<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Question::create([
            'name' => 'alcohol',
            'name_slug' => 'alcohol',
            'question' => 'Do you drink alcohol?',
            'answers' => 'yes:yes,no:no',
            'answer_type' => 'select',
            'level_min' => 0,
            'age_min' => 18
        ]);
        App\Question::create([
            'name' => 'gin beer',
            'name_slug' => 'gin_beer',
            'question' => 'Gin or Beer?',
            'answers' => 'Gin:gin,Beer:beer',
            'answer_type' => 'multiple',
            'level_min' => 0
        ]);
        App\Question::create([
            'name' => 'dessert',
            'name_slug' => 'dessert',
            'question' => 'What is your favourite dessert?',
            'answers' => 'Ice Cream:ice_cream,Cake:cake,Pancakes:pancakes',
            'answer_type' => 'multiple',
            'level_min' => 1
        ]);
    }
}

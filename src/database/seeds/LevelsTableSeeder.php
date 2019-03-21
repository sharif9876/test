<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Level::create([
            'level' => 0,
            'points' => 0,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#00ffff80'
        ]);
        App\Level::create([
            'level' => 1,
            'points' => 50,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#0000ff80'
        ]);
        App\Level::create([
            'level' => 2,
            'points' => 100,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#ff00ff80'
        ]);
        App\Level::create([
            'level' => 3,
            'points' => 150,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#00ff0080'
        ]);
        App\Level::create([
            'level' => 4,
            'points' => 200,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#00ff0080'
        ]);
        App\Level::create([
            'level' => 5,
            'points' => 250,
            'container_background_image_path' => '/images/loremipsum-background2.jpg',
            'container_background_color' => '#ff000080'
        ]);
    }
}

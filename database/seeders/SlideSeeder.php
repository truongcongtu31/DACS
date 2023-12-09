<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('slides')->insert([
            [
                'image' => 'images/slides/slide-01.jpg'
            ],
            [
                'image' => 'images/slides/slide-02.jpg'
            ],
            [
                'image' => 'images/slides/slide-03.jpg'
            ]
        ],
    );
    }
}

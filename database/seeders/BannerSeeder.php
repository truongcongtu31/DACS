<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('banners')->insert([
            [
                'name' => 'Man',
                'event' => 'Spring 2023',
                'image' => 'images/banners/banner-01.jpg'
            ],
            [
                'name' => 'Women',
                'event' => 'Christmas',
                'image' => 'images/banners/banner-02.jpg'
            ],
            [
                'name' => 'Kid',
                'event' => 'Luxury',
                'image' => 'images/banners/banner-03.jpg'
            ]
        ],
    );
    }
}

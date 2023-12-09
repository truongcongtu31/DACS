<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("menus")->insert([
            [
                'name' => 'Home',
                'url' => "home",
            ],
            [
                'name' => 'Shop',
                'url' => "shop",
            ],
            [
                'name' => 'Blog',
                'url' => "blog",
            ],
            [
                'name' => 'About',
                'url' => "about",
            ],
            [
                'name' => 'Contact',
                'url' => "contact",
            ]

        ]);
    }
}

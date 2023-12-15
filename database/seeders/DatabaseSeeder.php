<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SlideSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(MenuSeeder::class);
        User::factory(30)->create();
        Color::factory(8)->create();
        Product::factory(30)->create();
        Blog::factory(10)->create();
        Order::factory(50)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

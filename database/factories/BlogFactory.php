<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seed = $this->faker->randomNumber();
        $title = $this->faker->sentence;

        // Tạo và lưu ảnh cho blog
        $imagePath = "images/blogs/{$title}_main.jpg";
        Image::make("https://picsum.photos/800/400?random={$seed}")
            ->save(public_path($imagePath));

        return [
            'title' => $title,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->realText(200),
            'content1' => $this->faker->realText(500),
            'image' => $imagePath,
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
        ];
    }
}

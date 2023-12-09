<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $seed = $this->faker->randomNumber();

        // Tạo và lưu ảnh chính
        $imagePath = "images/products/{$name}_main.jpg";
        Image::make("https://picsum.photos/300/400?random={$seed}")
            ->save(public_path($imagePath));

        // Tạo và lưu các ảnh chi tiết
        $detailImagePaths = [];
        for ($i = 1; $i <= 3; $i++) {
            $detailImagePath = "images/products/{$name}_detail{$i}.jpg";
            Image::make("https://picsum.photos/500/600?random={$seed}")
                ->save(public_path($detailImagePath));
            $detailImagePaths[] = $detailImagePath;
        }

        return [
            'name' => $name,
            'image' => $imagePath,
            'image_detail_1' => $detailImagePaths[0],
            'image_detail_2' => $detailImagePaths[1],
            'image_detail_3' => $detailImagePaths[2],
            'description' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'quantity' => $this->faker->randomNumber(2),
            'color' => $this->faker->hexColor,
            'category_id' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
        ];
    }
}

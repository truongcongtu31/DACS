<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Color>
 */
class ColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colorCodes = ['#FFFFFF', '#000000', '#FF0000', '#808080', '#FFC0CB', '#008000', '#0000FF', '#FFD700'];

        $colorCode = $this->faker->unique()->randomElement($colorCodes);
        $name = $this->generateNameFromColorCode($colorCode);

        return [
            'name' => $name,
            'color_code' => $colorCode,
        ];
    }

    private function generateNameFromColorCode(string $colorCode): string
    {
        $colorNames = [
            '#FFFFFF' => 'White',
            '#000000' => 'Black',
            '#FF0000' => 'Red',
            '#808080' => 'Gray',
            '#FFC0CB' => 'Pink',
            '#008000' => 'Green',
            '#0000FF' => 'Blue',
            '#FFD700' => 'Gold',
        ];

        return $colorNames[$colorCode] ?? 'Unknown';
    }
}

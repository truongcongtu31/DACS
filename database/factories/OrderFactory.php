<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $payMethods = ['COD', 'ATM'];
        $statuses = ['received', 'not received'];

        return [
            'date' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'total_price' => $this->faker->randomFloat(2, 10, 200),
            'pay_method' => $this->faker->randomElement($payMethods),
            'status' => $this->faker->randomElement($statuses),
            'user_id' => $this->faker->numberBetween(1, 30),
            'created_at' => $this->faker->dateTimeBetween('-10 year', 'now'),
        ];
    }
}

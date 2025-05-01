<?php

namespace Database\Factories;

use App\Models\FoodItem;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'user_id' => User::factory(),
            'delivery_man_id' => User::factory(),
            'order_rating' => $this->faker->numberBetween(1, 5),
            'delivery_rating' => $this->faker->numberBetween(1, 5),
            'feedback' => $this->faker->sentence,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\FoodItem;
use App\Models\User;
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
            'food_item_id'=>FoodItem::inRandomOrder()->first()->id,
            'user_id'=>User::inRandomOrder()->first()->id,
            'rate'=>fake()->numberBetween(1,5),
            'review'=>fake()->sentence(),
        ];
    }
}

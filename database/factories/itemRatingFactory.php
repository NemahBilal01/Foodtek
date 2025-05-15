<?php

namespace Database\Factories;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemRating>
 */
class ItemRatingFactory extends Factory
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
            'rate'=>fake()->randomFloat(2,1,5),
            'review'=>fake()->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemOption>
 */
class ItemOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'=>Category::inRandomOrder()->first()->id,
            'name_ar' => fake()->unique()->word(),
            'name_en'=>fake()->unique()->randomElement(['Juice','Bread','Lettuce','Cheese','Mayonnaise','Ketchup']),
            'is_active'=>fake()->boolean(),
        ];
    }
}

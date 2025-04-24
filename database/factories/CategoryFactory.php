<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $category=;
        return [
            'name' => fake()->unique()->randomElement(['Sandwiches', 'Burger', 'Pasta', 'Pizza', 'shawrma', 'waffle', 'cake']),
            'image'=>fake()->imageUrl('640','450' ,'food'),
            'restaurant_id'=>Restaurant::inRandomOrder()->first()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\FoodItem;
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
            'name_en' => fake()->unique()->randomElement(['Sandwiches', 'Burger', 'Pasta', 'Pizza', 'shawrma', 'waffle', 'cake']),
            'name_ar' => fake()->unique()->randomElement(['ساندويش', 'برغر', 'باستا', 'بيتزا', 'شاورما', 'وافل', 'كيك']),
            'image'=>fake()->imageUrl('640','450' ,'food'),
            'is_active'=>fake()->boolean(),
            'restaurant_id'=>Restaurant::inRandomOrder()->first()->id,
        ];
    }
}

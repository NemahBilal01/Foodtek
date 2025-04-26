<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\FoodItem;
use App\Models\SpecialOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpecialOffer>
 */
class SpecialOfferFactory extends Factory
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
            'category_id'=>Category::inRandomOrder()->first()->id,
            'title_en' => fake()->words(2, true),
            'title_ar' => 'عرض خاص ' . fake()->word(),
            'description_en' => fake()->sentence(),
            'description_ar' => 'وصف العرض ' . fake()->word(),
            'discount_percentage' => fake()->numberBetween(5, 50),
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'image' => 'offers/default.jpg',
            'limit_amount'=>fake()->numberBetween(1, 50),
            'person_amount'=>fake()->numberBetween(1, 50),
            'is_active' =>fake()->boolean(),
        ];
    }

}

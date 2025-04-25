<?php

namespace Database\Factories;

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
            'discount_percent' =>fake()->randomFloat('2' ,'1','20'),
            'start_at'=>fake()->dateTimeThisYear(),
            'end_at'=>fake()->dateTimeThisYear(),
            'description'=>fake()->sentence(),
        ];
    }
}

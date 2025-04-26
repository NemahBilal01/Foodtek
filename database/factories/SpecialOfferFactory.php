<?php

namespace Database\Factories;

<<<<<<< HEAD
=======
use App\Models\FoodItem;
use App\Models\SpecialOffer;
>>>>>>> 63258a0786a437f6d730ae70822114c1ed7608e1
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
<<<<<<< HEAD
            'title_en' => fake()->words(2, true),
            'title_ar' => 'عرض خاص ' . fake()->word(),
            'description_en' => fake()->sentence(),
            'description_ar' => 'وصف العرض ' . fake()->word(),
            'discount_percentage' => fake()->numberBetween(5, 50),
            'start_date' => now(),
            'end_date' => now()->addDays(7),
            'image' => 'offers/default.jpg',
            'is_active' => true,
        ];
    }
    
=======
            'food_item_id'=>FoodItem::inRandomOrder()->first()->id,
            'discount_percent' =>fake()->randomFloat('2' ,'1','20'),
            'start_at'=>fake()->dateTimeThisYear(),
            'end_at'=>fake()->dateTimeThisYear(),
            'description'=>fake()->sentence(),
        ];
    }
>>>>>>> 63258a0786a437f6d730ae70822114c1ed7608e1
}

<?php

namespace Database\Factories;

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
    
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ItemOption;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\foodItem>
 */
class FoodItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id'=>Restaurant::inRandomOrder()->first()->id,
            'item_option_id'=>ItemOption::inRandomOrder()->first()->id,
            'name_en' => fake()->unique()->randomElement(['Margherita Pizza','Beef Burger','Sushi Platter','Pad Thai','Tiramisu','Fish and Chips','Tacos','Ramen','Pasta Carbonara','Cheesecake','Pho','Falafel Wrap']),
            'name_ar' => fake()->unique()->randomElement(['بيتزا مارغريتا',' برجر لحم بقري','طبق سوشي','باد تاي',' تيراميسو','سمك وبطاطا مقلية','تاكو','رامين','باستا كاربونارا','تشيز كيك','فو','راب فلافل']),
            'description_en' => fake()->sentence(),
            'description_ar' => 'وصف العرض ' . fake()->word(),
            'price'=>fake()->randomFloat('2' ,'1','20'),
            'image_path'=>fake()->imageUrl('640','450' ,'food'),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'is_available'=>fake()->boolean(),
            'created_at'=>now(),
        ];
    }
}

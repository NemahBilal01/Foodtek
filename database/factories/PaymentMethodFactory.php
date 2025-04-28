<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'title'=>'محفظتي',
            'type'=>fake()->randomElement(['visa' , 'MasterCard' , ' local wallet']),
            'last_four_digits'=>substr($this->faker->creditCardNumber, -4),
            'holder_name'=>fake()->name(),
            'card_number'=>fake()->creditCardNumber(),
            'expire_date'=> $this->faker->creditCardExpirationDate(),
            'CVC_code'=>fake()->numberBetween(100, 999),

             
        ];
    }
}

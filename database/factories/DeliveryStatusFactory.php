<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\DeliveryStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\deliveryStatues>
 */
class DeliveryStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = DeliveryStatus::class;
    public function definition(): array
    {
        return [
            'order_id'=>Order::inRandomOrder()->first()->id,
            'status'=>fake()->randomElement(['pending', 'dispatched', 'out_for_delivery', 'delivered']),
        ];
    }
}

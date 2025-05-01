<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'message' => $this->faker->sentence,
            'is_bot' => $this->faker->boolean(20),
            'is_archived' => $this->faker->boolean(10),
        ];
    }
}

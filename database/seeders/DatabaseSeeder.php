<?php

namespace Database\Seeders;

use App\Models\DeliveryStatues;
use App\Models\ItemOption;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            RestaurantSeeder::class,
            CategorySeeder::class,
            ItemOptionSeeder::class,
            FoodItemSeeder::class,
            CartItemSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            NotificationSeeder::class,
            AddressSeeder::class,
            DeliveryStatuesSeeder::class,
            DeliveryTrackingSeeder::class,
            PaymentSeeder::class,
            RatingSeeder::class,
            SpecialOfferSeeder::class,


        ]);

        // FoodItem::factory(10);

        // CartItem::factory(5)->create();

        // Order::factory(10)->create();

        // OrderItem::factory(10);




}
}

<?php

namespace Database\Seeders;

use App\Models\SpecialOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpoecialOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SpecialOffer::factory(20)->create();
    }
}

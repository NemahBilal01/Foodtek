<?php

namespace Database\Seeders;
use App\Models\SpecialOffer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        SpecialOffer::factory()->count(10)->create();
    }
    

    
}

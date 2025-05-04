<?php

namespace Database\Seeders;

use App\Models\itemRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class itemRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        itemRating::factory(30)->create();    }
}

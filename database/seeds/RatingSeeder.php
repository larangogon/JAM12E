<?php

use App\Entities\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        factory(Rating::class, 10)->create();
    }
}

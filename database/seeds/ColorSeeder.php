<?php

use App\Entities\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        factory(Color::class, 100)->create();
    }
}

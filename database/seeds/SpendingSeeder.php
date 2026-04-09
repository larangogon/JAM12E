<?php

use App\Entities\Spending;
use Illuminate\Database\Seeder;

class SpendingSeeder extends Seeder
{
    public function run(): void
    {
        factory(Spending::class, 10)->create();
    }
}

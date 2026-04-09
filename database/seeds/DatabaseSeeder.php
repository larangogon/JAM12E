<?php

use Database\Seeders\PermissionsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(
            [
                PermissionsTableSeeder::class,
                UserSeeder::class,
                CategorySeeder::class,
                SizeSeeder::class,
                ColorSeeder::class,
                ProductsTableSeeder::class,
                OrderSeeder::class,
                SpendingSeeder::class,
            ]
        );
    }
}

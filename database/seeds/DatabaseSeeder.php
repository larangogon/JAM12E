<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                PermissionsTableSeeder::class,
                UserSeeder::class,
                CategorySeeder::class,
                SizeSeeder::class,
                ColorSeeder::class,
                ProductsTableSeeder::class,
                //ImagenesSeeder::class,
                OrderSeeder::class,
                PaymentSeeder::class,
            ]
        );
    }
}

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
                CategorySeeder::class,
                SizeSeeder::class,
                ColorSeeder::class,
                ProductsTableSeeder::class,
            ]);

        $this->call(
            [
                PermissionsTableSeeder::class,
                UserSeeder::class,  
            ]);
    }
}

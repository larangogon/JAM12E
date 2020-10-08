<?php

use App\Imgproducts;
use Illuminate\Database\Seeder;

class ImagenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Imagen::class, 10)->create();
    }
}

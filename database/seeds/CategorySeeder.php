<?php

use App\Entities\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Hombre', 'Mujer', 'Hogar', 'Niño', 'Accesorios'];
        foreach ($categories as $category) {
            factory(Category::class)->create([
                'name' => $category
            ]);
        }
    }
}

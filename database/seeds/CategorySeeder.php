<?php

use App\Entities\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Hombre', 'Mujer', 'Hogar', 'Niño', 'Accesorios'];
        foreach ($categories as $category) {
            factory(Category::class)->create([
                'name' => $category,
            ]);
        }
    }
}

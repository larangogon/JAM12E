<?php

use App\Category;
use App\Color;
use App\Imagen;
use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 40)->create();
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();

        Product::inRandomOrder()->each(function ($product) use($colors, $sizes, $categories) {
            $product->colors()->attach(
                $colors->random(rand(1,5))->pluck('id')->toArray()
            );

            $product->sizes()->attach(
                $sizes->random(rand(1,5))->pluck('id')->toArray()
            );

            $product->categories()->attach(
                $categories->random(rand(1,2))->pluck('id')->toArray()
            );

            factory(Imagen::class, rand(1, 2))->create([
                'product_id' => $product->id
            ]);
        });
    }
}

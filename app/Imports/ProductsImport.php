<?php

namespace App\Imports;

use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class ProductsImport implements OnEachRow
{
    public function onRow(Row $row)
    {
        $row  = $row->toArray();

        $product = Product::firstOrCreate([
            'id'          => $row[0],
            'name'        => $row[1],
            'description' => $row[2],
            'price'       => $row[3],
            'stock'       => $row[4],
        ]);

        $colors = explode(',', $row[5]);
        $count = count($colors);
        foreach ($colors as $key => $color) {
            if ($key == $count - 1) {
                break;
            }
            $ColorId = Color::where('name', $color)->first();
            $product->colors()->attach($ColorId->id);
        }

        $sizes = explode(',', $row[6]);
        $count = count($sizes);
        foreach ($sizes as $key => $size) {
            if ($key == $count - 1) {
                break;
            }
            $sizeId = Size::where('name', $size)->first();
            $product->sizes()->attach($sizeId->id);
        }

        $categories = explode(',', $row[7]);
        $count = count($categories);
        foreach ($categories as $key => $category) {
            if ($key == $count - 1) {
                break;
            }
            $categoryId = Category::where('name', $category)->first();
            $product->categories()->attach($categoryId->id);
        }

        $imagenes = explode(',', $row[8]);
        $count = count($imagenes);
        foreach ($imagenes as $key => $imagen) {
            if ($key == $count - 1) {
                break;
            }
            $product->imagenes()->create([
                'name' => $imagen,
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Product;
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

        $product->colors()->create([
            'name' => $row[5],
        ]);

        $product->sizes()->create([
            'name' => $row[6],
        ]);

        $product->categories()->create([
            'name' => $row[7],
        ]);

        $product->imagenes()->create([
            'name' => $row[8],
        ]);
    }
}

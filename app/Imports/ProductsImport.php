<?php

namespace App\Imports;

use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements WithValidation, ToModel, WithBatchInserts
{
    public function model(array $row)
    {
        $product = Product::firstOrCreate(
            ['id' => $row[0]
            ],
            [
                'name'        => $row[1],
                'description' => $row[2],
                'price'       => $row[3],
                'stock'       => $row[4],
                'active'      => $row[5],
                'created_by'  => auth()->user()->id,
                'updated_by'  => auth()->user()->id
            ]
        );


        $sizes = explode(',', $row[7]);
        $count = count($sizes);
        foreach ($sizes as $key => $size) {
            if ($key == $count - 1) {
                break;
            }
            $sizeId = Size::where('name', $size)->first();
            $product->sizes()->attach($sizeId->id);
        }

        $categories = explode(',', $row[8]);
        $count = count($categories);
        foreach ($categories as $key => $category) {
            if ($key == $count - 1) {
                break;
            }
            $categoryId = Category::where('name', $category)->first();
            $product->categories()->attach($categoryId->id);
        }

        $imagenes = explode(',', $row[9]);
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

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            '*.1' => 'required',
            '*.2' => 'required',
            '*.3' => 'required',
            '*.4' => 'required',
            '*.5' => 'required',
            '*.6' => 'required',
            '*.7' => 'required',
            '*.8' => 'required',
            '*.9' => 'required',
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}

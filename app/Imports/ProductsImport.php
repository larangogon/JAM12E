<?php

namespace App\Imports;

use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProductsImport implements OnEachRow, WithValidation
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
            'created_by'  => auth()->user()->id,
            'updated_by'  => auth()->user()->id,
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

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.0' => 'required',
            '*.1' => 'required|max:25',
            '*.2' => 'required|max:250',
            '*.3' => 'required|numeric',
            '*.4' => 'required|numeric',
            '*.5' => ['required'],'exists:colors,id',
            '*.6' => ['required'],'exists:colors,id',
            '*.7' => ['required'],'exists:colors,id',
            '*.8' => 'required',
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

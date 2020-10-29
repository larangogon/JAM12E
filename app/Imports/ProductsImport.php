<?php

namespace App\Imports;

use App\Entities\Category;
use App\Entities\Color;
use App\Entities\Product;
use App\Entities\Size;
use App\Rules\CategoryRule;
use App\Rules\RuleColor;
use App\Rules\SizeRule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements WithValidation, ToModel, WithBatchInserts, withStartRow
{
    use Importable;
    use SkipsErrors;
    use SkipsFailures;

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|void|null
     */
    public function model(array $row)
    {
        $product = Product::updateOrCreate(
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

        $product->colors()->detach(null);

        $colors = explode(',', $row[6]);

        $count = count($colors);
        foreach ($colors as $key => $color) {
            if ($key == $count - 1) {
                break;
            }
            $colorBd = Color::where('name', $color)->first();
            $product->colors()->attach(array($colorBd->id));
        }


        $product->sizes()->detach(null);
        $sizes = explode(',', $row[7]);
        $count = count($sizes);
        foreach ($sizes as $key => $size) {
            if ($key == $count - 1) {
                break;
            }
            $sizeBd = Size::where('name', $size)->firstOrFail();
            $product->sizes()->attach($sizeBd->id);
        }

        $product->categories()->detach(null);
        $categories = explode(',', $row[8]);
        $count = count($categories);
        foreach ($categories as $key => $category) {
            if ($key == $count - 1) {
                break;
            }
            $categoryBd = Category::where('name', $category)->first();
            $product->categories()->attach($categoryBd->id);
        }

        $imagenes = explode(',', $row[9]);
        $count = count($imagenes);
        foreach ($imagenes as $key => $imagen) {
            if ($key == $count - 1) {
                break;
            }
            $product->imagenes()->updateOrCreate([
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
            '*.3' => ['required', 'numeric'],
            '*.4' => ['required', 'numeric'],
            '*.5' => ['required'],
            '*.6' => ['required', new RuleColor],
            '*.7' => ['required', new SizeRule],
            '*.8' => ['required', new CategoryRule],
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 2;
    }
}

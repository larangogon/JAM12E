<?php

namespace App\Exports;

use App\Entities\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsExport implements FromCollection, WithMapping, WithValidation, WithBatchInserts
{
    use Exportable;
    use RegistersEventListeners;

    /**
    * @return Collection
    */
    public function collection()
    {
        return Product::all();
    }

    /**
     * @return array
     * @var Product $product
     */
    public function map($product): array
    {
        $colors = '';
        foreach ($product->colors()->pluck('name') as $color) {
            $colors .= $color . ',';
        }

        $categories = '';
        foreach ($product->categories()->pluck('name') as $category) {
            $categories .= $category . ',';
        }

        $sizes = '';
        foreach ($product->sizes()->pluck('name') as $size) {
            $sizes .= $size . ',';
        }

        $imagenes = '';
        foreach ($product->imagenes()->pluck('name') as $imagen) {
            $imagenes .= $imagen . ',';
        }

        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $colors,
            $sizes,
            $categories,
            $imagenes,
            Date::dateTimeToExcel($product->created_at),
        ];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|max:25',
            'description' => 'required|max:250',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'img'         => 'required',
            'color'       => ['required'],'exists:colors,id',
            'category'    => ['required'],'exists:colors,id',
            'size'        => ['required'],'exists:sizes,id',
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

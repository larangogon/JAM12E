<?php

namespace App\Exports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
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
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $product->colors()->pluck('name'),
            $product->sizes()->pluck('name'),
            $product->categories()->pluck('name'),
            $product->imagenes()->pluck('name'),
            Date::dateTimeToExcel($product->created_at),
        ];
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            '#',
            'name',
            'Description',
            'price',
            'stock',
            'colores',
            'Tallas',
            'Categorias',
            'imagenes',
            'DateEcxel'
        ];
    }
}

<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdustsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }

    /**
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
            $product->colors,
            $product->sizes,
            $product->categories,
            $product->imagenes,
            Date::dateTimeToExcel($product->created_at),
        ];
    }

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

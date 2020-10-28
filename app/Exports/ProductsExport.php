<?php

namespace App\Exports;

use App\Entities\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
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
            $product->active,
            $colors,
            $sizes,
            $categories,
            $imagenes,
            Date::dateTimeToExcel($product->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Descripcion',
            'Precio',
            'Stock',
            'Estado',
            'Colores',
            'Tallas',
            'Categorias',
            'Imagenes',
            'Date',
        ];
    }
}

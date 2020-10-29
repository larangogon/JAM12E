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
        $col = array_keys($product->colors()->pluck('name')->toArray());
        foreach ($product->colors()->pluck('name')->toArray() as $key =>  $color) {
            if ($key === end($col)){
                $colors .= $color;
            } else {
                $colors .= $color . ',';
            }
        }

        $categories = '';
        $r = array_keys($product->categories()->pluck('name')->toArray());
        foreach ($product->categories()->pluck('name')->toArray() as $key => $category) {
            if ($key === end($r)){
                $categories .= $category;
            } else {
                $categories .= $category . ',';
            }
        }

        $sizes = '';
        $siz = array_keys($product->sizes()->pluck('name')->toArray());
        foreach ($product->sizes()->pluck('name')->toArray() as $key =>  $size) {
            if ($key === end($siz)){
                $sizes .= $size;
            } else {
                $sizes .= $size . ',';
            }
        }

        $imagenes = '';
        $img = array_keys($product->imagenes()->pluck('name')->toArray());
        foreach ($product->imagenes()->pluck('name')->toArray() as $key =>  $imagen) {
            if ($key === end($img)){
                $imagenes .= $imagen;
            } else {
                $imagenes .= $imagen . ',';
            }

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

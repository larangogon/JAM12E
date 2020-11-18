<?php

namespace App\Exports;

use App\Entities\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
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
            $product->barcode,
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

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Barcode',
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

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}

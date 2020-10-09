<?php

namespace App\Observers;

class ProductsObserver
{
    public function created($product)
    {
        logger()->channel('stack')->info('se ha creado un producto', [
            'name'        => $product->name,
            'stock'       => $product->stock,
            'price'       => $product->price,
            'description' => $product->description
        ]);
    }

    public function updated($product)
    {
        logger()->channel('stack')->info('se ha editado un producto', [
            'name'        => $product->name,
            'stock'       => $product->stock,
            'price'       => $product->price,
            'description' => $product->description
        ]);
    }
}

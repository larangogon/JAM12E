<?php

namespace App\Observers;

class ProductsObserver
{
    public function created($product)
    {
        logger()->info('se ha creado un producto', ['name' => $product->name]);
    }

    public function updated($product)
    {
        logger()->info('se ha editado un producto', ['name' => $product->name]);
    }
}

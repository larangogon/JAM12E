<?php

namespace App\Repositories\Api;

use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Interfaces\Api\InterfaceApiProducts;
use App\Product;

class ProductsApiRepo implements InterfaceApiProducts
{
    /**
     * @param ApiStoreRequest $request
     */
    public function store(ApiStoreRequest $request): void
    {
        $product = Product::create($request->all());

        $product->asignarColor($request->get('color'));
        $product->asignarCategory($request->get('category'));
        $product->asignarSize($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);
    }

    /**
     * @param ApiUpdateRequest $request
     * @param int $id
     */
    public function update(ApiUpdateRequest $request, int $id): void
    {
        $product = Product::find($id);
        $product->update($request->all());

        $product->colors()->sync($request->get('color'));
        $product->categories()->sync($request->get('category'));
        $product->sizes()->sync($request->get('size'));

        $files = $request->file('img');
        $product->asignarImagen($files, $product->id);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id): void
    {
        //
    }
}

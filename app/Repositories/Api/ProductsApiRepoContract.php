<?php

namespace App\Repositories\Api;

use App\Contracts\Api\ApiProductsContract;
use App\Entities\Product;
use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;

class ProductsApiRepoContract implements ApiProductsContract
{
    /**
     * @param ApiStoreRequest $request
     */
    public function store(ApiStoreRequest $request): void
    {
        $product = Product::create($request->all());

        $product->assignColor($request->get('color'));
        $product->assignCategory($request->get('category'));
        $product->assignSize($request->get('size'));

        $files = $request->file('img');
        $product->assignImage($files, $product->id);
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
        $product->assignImage($files, $product->id);
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

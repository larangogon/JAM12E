<?php

namespace App\Decorators;

use App\Contracts\ProductsContract;
use App\Entities\Product;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Repositories\ProductsContractRepo;
use Illuminate\Support\Facades\Cache;

class DecoratorProduct implements ProductsContract
{
    public function __construct(public readonly ProductsContractRepo $productsRepo)
    {
    }

    public function store(ItemCreateRequest $request): void
    {
        $this->productsRepo->store($request);

        Cache::tags('products')->flush();
    }

    public function update(ItemUpdateRequest $request, Product $product): void
    {
        $this->productsRepo->update($request, $product);

        Cache::tags('products')->flush();
    }

    public function destroy(Product $product): void
    {
        $this->productsRepo->destroy($product);

        Cache::tags('products')->flush();
    }

    public function destroyimagen(int $id, Product $product): void
    {
        $this->productsRepo->destroyimagen($id, $product);

        Cache::tags('products')->flush();
    }

    public function active(Product $product): void
    {
        $this->productsRepo->active($product);

        Cache::tags('products')->flush();
    }
}

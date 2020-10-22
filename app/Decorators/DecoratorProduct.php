<?php

namespace App\Decorators;

use App\Entities\Product;
use App\Repositories\ProductsRepo;
use App\Interfaces\InterfaceProducts;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;

class DecoratorProduct implements InterfaceProducts
{
    protected $productsRepo;

    /**
     * DecoratorProduct constructor.
     * @param ProductsRepo $productsRepo
     */
    public function __construct(ProductsRepo $productsRepo)
    {
        $this->productsRepo = $productsRepo;
    }

    /**
     * @param ItemCreateRequest $request
     */
    public function store(ItemCreateRequest $request): void
    {
        $this->productsRepo->store($request);

        Cache::tags('products')->flush();
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     */
    public function update(ItemUpdateRequest $request, Product $product): void
    {
        $this->productsRepo->update($request, $product);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        $this->productsRepo->destroy($id);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     * @param Product $product
     */
    public function destroyimagen(int $id, Product $product): void
    {
        $this->productsRepo->destroyimagen($id, $product);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     */
    public function active(int $id): void
    {
        $this->productsRepo->active($id);

        Cache::tags('products')->flush();
    }
}

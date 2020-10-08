<?php

namespace App\Decorators;

use App\Product;
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
     * @return mixed|void
     */
    public function store(ItemCreateRequest $request): Void
    {
        $this->productsRepo->store($request);

        Cache::tags('products')->flush();
    }

    /**
     * @param ItemUpdateRequest $request
     * @param Product $product
     * @return Void
     */
    public function update(ItemUpdateRequest $request, Product $product): Void
    {
        $this->productsRepo->update($request, $product);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function destroy(int $id): Void
    {
        $this->productsRepo->destroy($id);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $imagen_id
     * @param int $product_id
     * @return mixed|void
     */
    public function destroyimagen(int $imagen_id, int $product_id): Void
    {
        $this->productsRepo->destroyimagen($imagen_id, $product_id);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function active(int $id): Void
    {
        $this->productsRepo->active($id);

        Cache::tags('products')->flush();
    }
}

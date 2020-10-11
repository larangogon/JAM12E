<?php

namespace App\Decorators\Api;

use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Interfaces\Api\InterfaceApiProducts;
use App\Repositories\Api\ProductsApiRepo;
use Illuminate\Support\Facades\Cache;

class DecoratorApiProduct implements InterfaceApiProducts
{
    protected $productsApiRepo;

    /**
     * DecoratorApiProduct constructor.
     * @param ProductsApiRepo $productsApiRepo
     */
    public function __construct(ProductsApiRepo $productsApiRepo)
    {
        $this->productsApiRepo = $productsApiRepo;
    }

    /**
     * @param ApiStoreRequest $request
     */
    public function store(ApiStoreRequest $request): void
    {
        $this->productsApiRepo->store($request);

        Cache::tags('products')->flush();
    }

    /**
     * @param ApiUpdateRequest $request
     * @param int $id
     */
    public function update(ApiUpdateRequest $request, int $id): void
    {
        $this->productsApiRepo->update($request, $id);

        Cache::tags('products')->flush();
    }

    /**
     * @param int $id
     */
    public function destroy(int $id): void
    {
        $this->productsApiRepo->destroy($id);

        Cache::tags('products')->flush();
    }
}

<?php

namespace App\Decorators\Api;

use App\Contracts\Api\ApiProductsContract;
use App\Http\Requests\ApiStoreRequest;
use App\Http\Requests\ApiUpdateRequest;
use App\Repositories\Api\ProductsApiRepoContract;
use Illuminate\Support\Facades\Cache;

class DecoratorApiProduct implements ApiProductsContract
{
    public function __construct(public readonly ProductsApiRepoContract $productsApiRepo)
    {
    }

    public function store(ApiStoreRequest $request): void
    {
        $this->productsApiRepo->store($request);

        Cache::tags('products')->flush();
    }

    public function update(ApiUpdateRequest $request, int $id): void
    {
        $this->productsApiRepo->update($request, $id);

        Cache::tags('products')->flush();
    }

    public function destroy(int $id): void
    {
        $this->productsApiRepo->destroy($id);

        Cache::tags('products')->flush();
    }
}

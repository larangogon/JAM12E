<?php

namespace App\Decorators;

use App\Contracts\CategoriesContract;
use App\Repositories\CategoriesContractRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DecoratorCategory implements CategoriesContract
{
    public function __construct(public readonly CategoriesContractRepo $categoriesRepo)
    {
    }

    public function store(Request $request): void
    {
        $this->categoriesRepo->store($request);

        Cache::tags('categories')->flush();
    }
}

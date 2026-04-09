<?php

namespace App\Decorators;

use App\Contracts\SizesContract;
use App\Repositories\SizesContractRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DecoratorSize implements SizesContract
{
    public function __construct(public readonly SizesContractRepo $sizesRepo)
    {
    }

    public function store(Request $request): void
    {
        $this->sizesRepo->store($request);

        Cache::tags('sizes')->flush();
    }
}

<?php

namespace App\Decorators;

use Illuminate\Http\Request;
use App\Repositories\SizesRepo;
use App\Interfaces\InterfaceSizes;
use Illuminate\Support\Facades\Cache;

class DecoratorSize implements InterfaceSizes
{
    protected $sizesRepo;

    /**
     * DecoratorSize constructor.
     * @param SizesRepo $sizesRepo
     */
    public function __construct(SizesRepo $sizesRepo)
    {
        $this->sizesRepo = $sizesRepo;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        $this->sizesRepo->store($request);

        Cache::tags('sizes')->flush();
    }
}

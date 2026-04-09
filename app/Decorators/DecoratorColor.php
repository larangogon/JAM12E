<?php

namespace App\Decorators;

use App\Contracts\ColorsContract;
use App\Repositories\ColorsContractRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DecoratorColor implements ColorsContract
{
    public function __construct(public readonly ColorsContractRepo $colorsRepo)
    {
    }

    public function store(Request $request): void
    {
        $this->colorsRepo->store($request);

        Cache::tags('colors')->flush();
    }
}

<?php

namespace App\Decorators;

use Illuminate\Http\Request;
use App\Repositories\ColorsRepo;
use App\Interfaces\InterfaceColors;
use Illuminate\Support\Facades\Cache;

class DecoratorColor implements InterfaceColors
{
    protected $colorsRepo;

    /**
     * DecoratorColor constructor.
     * @param ColorsRepo $colorsRepo
     */
    public function __construct(ColorsRepo $colorsRepo)
    {
        $this->colorsRepo = $colorsRepo;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        $this->colorsRepo->store($request);

        Cache::tags('colors')->flush();
    }
}

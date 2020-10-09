<?php

namespace App\Decorators;

use Illuminate\Http\Request;
use App\Repositories\CategoriesRepo;
use App\Interfaces\InterfaceCategories;
use Illuminate\Support\Facades\Cache;

class DecoratorCategory implements InterfaceCategories
{
    protected $categoriesRepo;

    /**
     * DecoratorCategory constructor.
     * @param CategoriesRepo $categoriesRepo
     */
    public function __construct(CategoriesRepo $categoriesRepo)
    {
        $this->categoriesRepo = $categoriesRepo;
    }

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): void
    {
        $this->categoriesRepo->store($request);

        Cache::tags('categories')->flush();
    }
}

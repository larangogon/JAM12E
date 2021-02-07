<?php

namespace App\Repositories;

use App\Entities\Category;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceCategories;

class CategoriesRepo implements InterfaceCategories
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $category = Category::create($request->all());
    }
}

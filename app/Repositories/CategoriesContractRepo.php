<?php

namespace App\Repositories;

use App\Contracts\CategoriesContract;
use App\Entities\Category;
use Illuminate\Http\Request;

class CategoriesContractRepo implements CategoriesContract
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $category = Category::create($request->all());
    }
}

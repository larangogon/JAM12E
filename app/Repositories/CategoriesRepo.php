<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceCategories;

class CategoriesRepo implements InterfaceCategories
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): Void
    {
        $role = new Category();
        $role->name = request('name');

        $role->save();
    }
}

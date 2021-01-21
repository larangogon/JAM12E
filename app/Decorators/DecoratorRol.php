<?php

namespace App\Decorators;

use Illuminate\Http\Request;
use App\Interfaces\InterfaceRoles;
use Illuminate\Support\Facades\Cache;

class DecoratorRol implements InterfaceRoles
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): void
    {
        Cache::tags('roles')->flush();
    }
}

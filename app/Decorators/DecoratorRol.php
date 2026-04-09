<?php

namespace App\Decorators;

use App\Contracts\RolesContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DecoratorRol implements RolesContract
{
    public function store(Request $request): void
    {
        Cache::tags('roles')->flush();
    }
}

<?php

namespace App\Repositories;

use App\Entities\Size;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceSizes;

class SizesRepo implements InterfaceSizes
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $size = Size::create($request->all());
    }
}

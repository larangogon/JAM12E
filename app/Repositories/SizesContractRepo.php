<?php

namespace App\Repositories;

use App\Contracts\SizesContract;
use App\Entities\Size;
use Illuminate\Http\Request;

class SizesContractRepo implements SizesContract
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $size = Size::create($request->all());
    }
}

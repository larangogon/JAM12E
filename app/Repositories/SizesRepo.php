<?php

namespace App\Repositories;

use App\Size;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceSizes;

class SizesRepo implements InterfaceSizes
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): void
    {
        $size = new Size();

        $size->name = request('name');

        $size->save();
    }
}

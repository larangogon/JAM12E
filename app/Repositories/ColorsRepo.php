<?php

namespace App\Repositories;

use App\Entities\Color;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceColors;

class ColorsRepo implements InterfaceColors
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $color = Color::create($request->all());
    }
}

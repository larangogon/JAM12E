<?php

namespace App\Repositories;

use App\Color;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceColors;

class ColorsRepo implements InterfaceColors
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): Void
    {
        $color = new Color();
        $color->name = request('name');

        $color->save();
    }
}

<?php

namespace App\Repositories;

use App\Contracts\ColorsContract;
use App\Entities\Color;
use Illuminate\Http\Request;

class ColorsContractRepo implements ColorsContract
{
    /**
     * @param Request $request
     */
    public function store(Request $request): void
    {
        $color = Color::create($request->all());
    }
}

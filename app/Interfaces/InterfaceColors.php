<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface InterfaceColors
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);
}

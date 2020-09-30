<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface InterfaceSizes
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);
}

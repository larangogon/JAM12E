<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface InterfaceRoles
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);
}

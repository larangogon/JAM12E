<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;

interface InterfaceRoles
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);
}

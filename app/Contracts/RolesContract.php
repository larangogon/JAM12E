<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface RolesContract
{
    public function store(Request $request);
}

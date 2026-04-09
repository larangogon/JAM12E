<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ColorsContract
{
    public function store(Request $request);
}

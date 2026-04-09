<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface SizesContract
{
    public function store(Request $request);
}

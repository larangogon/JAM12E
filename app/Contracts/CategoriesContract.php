<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CategoriesContract
{
    public function store(Request $request);
}

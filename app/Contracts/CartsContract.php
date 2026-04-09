<?php

namespace App\Contracts;

use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Http\Request;

interface CartsContract
{
    public function add(CartAddRequest $request);
    public function remove();
    public function destroy(Request $request);
    public function update(CartUpdateRequest $request, int $id);
}

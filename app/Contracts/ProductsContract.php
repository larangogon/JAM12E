<?php

namespace App\Contracts;

use App\Entities\Product;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;

interface ProductsContract
{
    public function store(ItemCreateRequest $request);
    public function update(ItemUpdateRequest $request, Product $product);
    public function destroy(Product $product);
    public function destroyimagen(int $id, Product $product);
    public function active(Product $product);
}

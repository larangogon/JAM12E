<?php

namespace App\Interfaces;

use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Product;

interface InterfaceProducts
{
    /**
     * @param ItemCreateRequest $request
     * @return mixed
     */
    public function store(ItemCreateRequest $request);

    /**
     * @param ItemUpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(ItemUpdateRequest $request, Product $product);

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param int $imagen_id
     * @param int $product_id
     * @return mixed
     */
    public function destroyimagen(int $imagen_id, int $product_id);

    /**
     * @param int $id
     * @return mixed
     */
    public function active(int $id);
}

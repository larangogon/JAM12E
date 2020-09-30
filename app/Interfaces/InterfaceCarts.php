<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;

interface InterfaceCarts
{
    /**
     * @param CartAddRequest $request
     * @return mixed
     */
    public function add(CartAddRequest $request);

    /**
     * @return mixed
     */
    public function remove();

    /**
     * @param Request $request
     * @return mixed
     */
    public function destroy(Request $request);

    /**
     * @param CartUpdateRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(CartUpdateRequest $request, int $id);
}

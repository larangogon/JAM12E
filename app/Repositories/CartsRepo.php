<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\InterfaceCarts;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;

class CartsRepo implements InterfaceCarts
{
    /**
     * @param CartAddRequest $request
     * @return mixed|void
     */
    public function add(CartAddRequest $request): Void
    {
        //
    }

    /**
     * @return mixed|void
     */
    public function remove(): Void
    {
        //
    }

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function destroy(Request $request): Void
    {
        //
    }

    /**
     * @param CartUpdateRequest $request
     * @param int $id
     * @return Void
     */
    public function update(CartUpdateRequest $request, int $id): Void
    {
        //
    }
}

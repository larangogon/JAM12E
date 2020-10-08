<?php

namespace App\Decorators;

use App\InCart;
use Illuminate\Http\Request;
use App\Repositories\CartsRepo;
use App\Interfaces\InterfaceCarts;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;

class DecoratorCart implements InterfaceCarts
{
    protected $cartsRepo;

    /**
     * DecoratorCart constructor.
     * @param CartsRepo $cartsRepo
     */
    public function __construct(CartsRepo $cartsRepo)
    {
        $this->cartsRepo = $cartsRepo;
    }

    /**
     * @param CartAddRequest $request
     * @return mixed|void
     */
    public function add(CartAddRequest $request): Void
    {
        $this->cartsRepo->add($request);

        $product = $request->get('products_id');
        $stock   = $request->get('stock');
        $color   = $request->get('color_id');
        $size    = $request->get('size_id');

        Auth::user()->cart->products()
            ->attach($product, [
                'stock'    => $stock,
                'color_id' => $color,
                'size_id'  => $size
            ]);
    }

    /**
     * @return mixed|void
     */
    public function remove(): Void
    {
        Auth::user()->cart->products()->detach(null);
    }

    /**
     * @param Request $request
     * @return mixed|void
     */
    public function destroy(Request $request): Void
    {
        $pivot_id  = ($request->get('id'));
        $item_cart = InCart::find($pivot_id);

        $item_cart->delete();
    }

    /**
     * @param CartUpdateRequest $request
     * @param int $id
     * @return Void
     */
    public function update(CartUpdateRequest $request, int $id): Void
    {
        $this->cartsRepo->update($request, $id);

        $inCartItem = InCart::findOrFail($id);

        $inCartItem->stock = $request->get('stock');

        $inCartItem->update();
    }
}

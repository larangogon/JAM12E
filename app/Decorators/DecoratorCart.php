<?php

namespace App\Decorators;

use App\Entities\InCart;
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
     * @return void
     */
    public function add(CartAddRequest $request): void
    {
        $this->cartsRepo->add($request);

        $product   = $request->get('products_id');
        $stock     = $request->get('stock');
        $color     = $request->get('color_id');
        $size      = $request->get('size_id');
        $category  = $request->get('category_id');

        Auth::user()->cart->products()
            ->attach($product, [
                'stock'       => $stock,
                'color_id'    => $color,
                'category_id' => $category,
                'size_id'     => $size
            ]);
    }

    /**
     * @return void
     */
    public function remove(): void
    {
        Auth::user()->cart->products()->detach(null);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request): void
    {
        $pivot_id  = ($request->get('id'));
        $item_cart = InCart::find($pivot_id);

        $item_cart->delete();
    }

    /**
     * @param CartUpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(CartUpdateRequest $request, int $id): void
    {
        $this->cartsRepo->update($request, $id);

        $inCartItem = InCart::findOrFail($id);

        $inCartItem->stock = $request->get('stock');

        $inCartItem->update();
    }
}

<?php

namespace App\Decorators;

use App\Contracts\CartsContract;
use App\Entities\InCart;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DecoratorCart implements CartsContract
{
    public function add(CartAddRequest $request): void
    {
        $product = $request->get('products_id');
        $stock = $request->get('stock');
        $color = $request->get('color_id');
        $size = $request->get('size_id');
        $category = $request->get('category_id');

        Auth::user()
            ->cart
            ->products()
            ->attach($product, [
                'stock'       => $stock,
                'color_id'    => $color,
                'category_id' => $category,
                'size_id'     => $size,
            ]);
    }

    public function remove(): void
    {
        Auth::user()->cart->products()->detach(null);
    }

    public function destroy(Request $request): void
    {
        $pivot_id = ($request->get('id'));
        $item_cart = InCart::find($pivot_id);

        $item_cart->delete();
    }

    public function update(CartUpdateRequest $request, int $id): void
    {
        $inCartItem = InCart::findOrFail($id);

        $inCartItem->stock = $request->get('stock');

        $inCartItem->update();
    }
}

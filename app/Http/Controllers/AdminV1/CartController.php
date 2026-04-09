<?php

namespace App\Http\Controllers\AdminV1;

use App\Contracts\CartsContract;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $carts;

    /**
     * CartController constructor.
     * @param CartsContract $carts
     */
    public function __construct(CartsContract $carts)
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->carts = $carts;
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return view('cart.show', [
            'cart' => Auth::user()->cart,
        ]);
    }

    /**
     * @param CartAddRequest $request
     * @return RedirectResponse
     */
    public function add(CartAddRequest $request): RedirectResponse
    {
        $product = Product::where('id', '=', $request->products_id)
            ->first();
        if ($product->stock < $request->stock) {
            return redirect()
                ->back()
                ->with('success', 'Excede la cantidad disponible');
        }
        $this->carts->add($request);

        return redirect()
            ->back()
            ->with('success', 'Producto agregado al carrito con éxito');
    }

    /**
     * @return RedirectResponse
     */
    public function remove(): RedirectResponse
    {
        $this->carts->remove();

        return redirect()
            ->route('cart.show', [
                'cart' => Auth::user()->cart,
            ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->carts->destroy($request);

        return redirect()
            ->back()
            ->with('success', 'Eliminado Satisfactoriamente !');
    }

    /**
     * @param CartUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CartUpdateRequest $request, int $id): RedirectResponse
    {
        $this->carts->update($request, $id);

        return redirect()
            ->back()
            ->with('success', 'Actualizado Satisfactoriamente !');
    }
}

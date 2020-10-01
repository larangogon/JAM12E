<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\CartUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\InterfaceCarts;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $carts;

    /**
     * CartController constructor.
     * @param InterfaceCarts $carts
     */
    public function __construct(InterfaceCarts $carts)
    {
        $this->middleware('auth');
        $this->middleware('Status');
        $this->middleware('verified');
        $this->carts = $carts;
    }

    /**
     * @return view
     */
    public function show(): view
    {
        return view('cart.show', ['cart' => Auth::user()->cart]);
    }

    /**
     * @param CartAddRequest $request
     * @return RedirectResponse
     */
    public function add(CartAddRequest $request): RedirectResponse
    {
        $this->carts->add($request);

        return redirect()->back()->with('success', 'product added to cart succesfully');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(): RedirectResponse
    {
        $this->carts->remove();

        return redirect()->route("cart.show", ['cart' => Auth::user()->cart]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->carts->destroy($request);

        Session::flash('message', 'Eliminado Satisfactoriamente !');

        return redirect()->route("cart.show", ['cart' => Auth::user()->cart]);
    }

    public function update(CartUpdateRequest $request, int $id): RedirectResponse
    {
        $this->carts->update($request, $id);

        Session::flash('message', 'Actualizado Satisfactoriamente !');

        return redirect()->route("cart.show", ['cart' => Auth::user()->cart]);
    }
}
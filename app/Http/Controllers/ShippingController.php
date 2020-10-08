<?php

namespace App\Http\Controllers;

use App\Shipping;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ShippingRequest;

class ShippingController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('shipping.create');
    }

    /**
     * @param ShippingRequest $request
     * @param Shipping $shipping
     * @return RedirectResponse
     */
    public function store(ShippingRequest $request, Shipping $shipping): RedirectResponse
    {
        $shipping->create($request->all());

        return redirect('vitrina')
            ->with('message', 'Los datos para tu envio se han guardado exitosamente!');
    }
}

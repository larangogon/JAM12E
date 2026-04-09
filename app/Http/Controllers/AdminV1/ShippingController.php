<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Shipping;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

        return redirect()
            ->back()
            ->with('message', 'Los datos para tu envio se han guardado exitosamente!');
    }
}

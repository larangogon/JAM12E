<?php

namespace App\Repositories;

use App\Http\Requests\RequestOrderStore;
use Illuminate\Http\Request;
use App\Interfaces\InterfaceOrders;

class OrdersRepo implements InterfaceOrders
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): void
    {
        //
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id): void
    {
        //
    }

    /**
     * @param Request $request
     */
    public function resend(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function reversePay(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function complete(Request $request)
    {
        //
    }

    /**
     * @param RequestOrderStore $request
     * @return mixed|void
     */
    public function paymentInStore(RequestOrderStore $request)
    {
        //
    }
}

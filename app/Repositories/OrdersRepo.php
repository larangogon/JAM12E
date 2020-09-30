<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\InterfaceOrders;

class OrdersRepo implements InterfaceOrders
{
    /**
     * @param Request $request
     * @return mixed|void
     */
    public function store(Request $request): Void
    {
        //
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function update(Request $request, int $id): Void
    {
        //
    }


    /**
     * @param int $order_id
     * @param string $status
     */
    public function status(int $order_id, string $status)
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
}

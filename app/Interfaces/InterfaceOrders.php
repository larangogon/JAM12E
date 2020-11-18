<?php

namespace App\Interfaces;

use App\Http\Requests\RequestOrderStore;
use Illuminate\Http\Request;

interface InterfaceOrders
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, int $id);

    /**
     * @param Request $request
     * @return mixed
     */
    public function resend(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function reversePay(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function complete(Request $request);

    /**
     * @param RequestOrderStore $request
     * @return mixed
     */
    public function paymentInStore(RequestOrderStore $request);
}

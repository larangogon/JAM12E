<?php

namespace App\Contracts;

use App\Http\Requests\RequestOrderStore;
use Illuminate\Http\Request;

interface OrdersContract
{
    public function store(Request $request);
    public function update(Request $request, int $id);
    public function resend(Request $request);
    public function reversePayment(Request $request);
    public function complete(Request $request);
    public function paymentInStore(RequestOrderStore $request);
}

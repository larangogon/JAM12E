<?php

namespace App\Observers;

use App\Entities\Payment;
use App\Events\PaymentIsCreated;
use App\Jobs\PayActuality;

class PaymentObserver
{
    /**
     * @param Payment $payment
     */
    public function updated(Payment $payment)
    {
        $status = $payment->status;

        $order = $payment->order;

        $order->status = $status;

        $order->save();

        if ($payment->status === 'APPROVED') {
            PayActuality::dispatch($payment)->delay(now()->addMinutes(1));
        }

        event(new PaymentIsCreated($payment));
    }

    public function created(Payment $payment)
    {
        if ($payment->status === 'APROVADO_T') {
            event(new PaymentIsCreated($payment));
        }
    }
}

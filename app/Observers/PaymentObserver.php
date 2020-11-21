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

        event(new PaymentIsCreated($payment));

        if ($payment->status === 'APPROVED') {
            PayActuality::dispatch($payment)->delay(now()->addMinutes(1));
        }
    }

    public function created(Payment $payment)
    {
        if ($payment->status === 'APROVADO_T') {
            event(new PaymentIsCreated($payment));

            $payment->expiration = now()->addDays(30)->toDateString();
        }
        $payment->save();
    }
}

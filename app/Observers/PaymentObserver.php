<?php

namespace App\Observers;

use App\Entities\Payment;
use App\Events\PaymentIsCreated;

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

        logger()->channel('stack')->info('se ha editado un pago', [
            'status' => $payment->status, 'order' => $payment->order,
        ]);

        if ($payment->status === 'APPROVED') {
            $payment->expiration = now()->addDays(30)->toDateString();
        }

        $payment->save();
    }

    public function created(Payment $payment)
    {
        if ($payment->status == 'APROVADO_T') {
            event(new PaymentIsCreated($payment));

            $payment->expiration = now()->addDays(30)->toDateString();
        }
        $payment->save();
    }
}

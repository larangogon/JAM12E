<?php

namespace App\Observers;

use App\Payment;

class PaymentObserver
{
    /**
     * Handle the payment "updated" event.
     *
     * @param  \App\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $status = $payment->status;

        $order = $payment->order;

        $order->status = $status;

        $order->save();

        logger()->channel('stack')->info('se ha editado un pago', [
            'status' => $payment->status, 'order' => $payment->order,
        ]);
    }
    public function created($payment)
    {
        logger()->channel('stack')->info('se ha creado un pago', [
            'status' => $payment->status, 'order' => $payment->order,
        ]);
    }
}

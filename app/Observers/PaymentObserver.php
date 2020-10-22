<?php

namespace App\Observers;

use App\Entities\Payment;

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

        logger()->channel('stack')->info('se ha editado un pago', [
            'status' => $payment->status, 'order' => $payment->order,
        ]);
    }

    /**
     * @param $payment
     */
    public function created($payment)
    {
        logger()->channel('stack')->info('se ha creado un pago', [
            'status' => $payment->status, 'order' => $payment->order,
        ]);
    }
}

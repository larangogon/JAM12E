<?php

namespace App\Observers;

use App\Entities\Payment;

class ExpirationPayObserver
{
    /**
     * @param Payment $payment
     */
    public function updated(Payment $payment)
    {
        if ($payment->status === 'APPROVED')

            $payment->expiration = now()->addDays(30)->toDateString();

        $payment->save();
    }

    /**
     * @param Payment $payment
     */
    public function created(Payment $payment)
    {
        if ($payment->status === 'APROVADO_T')

            $payment->expiration = now()->addDays(30)->toDateString();

        $payment->save();
    }
}

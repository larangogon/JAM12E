<?php

namespace App\Observers;

use App\Entities\Payment;
use App\Events\PaymentIsCreated;

class PaymentMetricObserver
{
    /**
     * @param Payment $payment
     */
    public function updated(Payment $payment)
    {
        event(new PaymentIsCreated($payment));
    }
}

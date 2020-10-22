<?php

namespace App\Events;

use App\Entities\Payment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentIsCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $payment;

    /**
     * OrderIsCreated constructor.
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
}

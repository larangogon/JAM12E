<?php

namespace App\Console\Commands;

use App\Constants\Statuses;
use App\Entities\Payment;
use App\Jobs\ProcessP2p;
use Illuminate\Console\Command;

class PaymentOrders extends Command
{
    protected $signature = 'payment:orders';

    protected $description = 'Actualizar pago consulata de p2p';

    public function handle(): void
    {
        logger()->channel('stack')->info('se han actualizado los pagos pendientes');

        $payments = Payment::where('status', Statuses::PENDING)->get();

        foreach ($payments as $payment) {
            dispatch(new ProcessP2p($payment->order));
        }
    }
}

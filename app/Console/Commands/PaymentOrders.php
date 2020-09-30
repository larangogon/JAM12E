<?php

namespace App\Console\Commands;

use App\Jobs\ProcessP2p;
use App\Order;
use App\Payment;
use Illuminate\Console\Command;

class PaymentOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar pago consulata de p2p';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Payment $payment)
    {
        logger()->info('se han actualizado los pagos p2p');
        $payments = Payment::where('status', 'PENDING')->get();

        foreach ($payments as $payment) {
            dispatch(new ProcessP2p($payment->order));
        }
    }
}

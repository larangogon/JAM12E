<?php

namespace App\Jobs;

use App\Constants\PlaceToPay;
use App\Order;
use App\Decorators\DecoratorOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessP2p implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    protected $order;

    /**
     * ProcessP2p constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @param DecoratorOrder $orderD
     * @throws \Exception
     */
    public function handle(DecoratorOrder $orderD)
    {
        if ($this->order->payment->status === PlaceToPay::PENDING) {
            $response = $orderD->requestP2P('getRequestinformation', $this->order);

            $status             = $response->status->status;
            $amount             = $response->payment[0]->amount->from->total;
            $internalReference  = $response->payment[0]->internalReference;
            $message            = $response->status->message;
            $payerdocument      = $response->request->payer->document;
            $payername          = $response->request->payer->name;
            $payeremail         = $response->request->payer->email;
            $payermobile        = $response->request->payer->mobile;
            $locale             = $response->request->locale;

            $this->order->payment->update([
                'internalReference' => $internalReference,
                'status'            => $status,
                "message"           => $message,
                'amount'            => $amount,
                'document'          => $payerdocument,
                'name'              => $payername,
                'email'             => $payeremail,
                'mobile'            => $payermobile,
                'locale'            => $locale,
            ]);
        }
    }
}

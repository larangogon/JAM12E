<?php

namespace App\Mail;

use App\Entities\Order;
use App\Entities\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendEmailReport extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct($ordersx)
    {
        $this->ordersx = $ordersx;
    }

    /**
     * @return SendEmailReport
     */
    public function build()
    {
        $now = new \DateTime();
        $pdf = \PDF::loadView('reports.orders', [
            'now'       => $now,
            'order'     => $this->ordersx,
            ]);

        Storage::disk('public')->put(date('Y-m-d-H-i-s').'reports.orders.pdf', $pdf);

        return $this->from('johannitaarango2@gmail.com')
        ->view('emails.report')
        ->attachData($pdf->output(), 'reports.orders.pdf');
    }
}

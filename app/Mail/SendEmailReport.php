<?php

namespace App\Mail;

use App\Entities\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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
        $name = date('Y-m-d-H-i') . 'report.pdf';
        $pdf = \PDF::loadView('reports.orders', [
            'now'       => $now,
            'order'     => $this->ordersx,
            ])->save(storage_path('app/') . $name);

        return $this->from('johannitaarango2@gmail.com')
        ->view('emails.report')
        ->attachData($pdf->output(), 'reports.orders.pdf');
    }
}

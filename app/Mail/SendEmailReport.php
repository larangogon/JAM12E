<?php

namespace App\Mail;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SendEmailReport extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }
    public function build(): self
    {
        $now = new DateTime();

        $name = date('Y-m-d-H-i') . 'report.pdf';

        $pdf = PDF::loadView('reports.orders', [
            'now' => $now,
            'order' => $this->orders,
        ])->save(storage_path('app/') . $name);

        return $this->from(config('jam.email_report_from'))
            ->view('emails.report')
            ->attachData($pdf->output(), 'reports.orders.pdf');
    }
}

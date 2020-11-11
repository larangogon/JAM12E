<?php

namespace App\Mail;

use App\Report\ReportGeneralPdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendEmailReportGeneral extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @return SendEmailReportGeneral
     */
    public function build()
    {
        $pdf = new ReportGeneralPdf;
        Storage::disk('public')->put(date('Y-m-d-H-i-s') . 'reports.reportGeneral.pdf', $pdf);

        return $this->from('johannitaarango2@gmail.com')
            ->view('emails.report')
            ->attachData($pdf->output(), 'reports.reportGeneral.pdf');
    }
}

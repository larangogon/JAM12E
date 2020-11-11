<?php

namespace App\Mail;

use App\Entities\Cancelled;
use App\Entities\Detail;
use App\Entities\Order;
use App\Entities\Payment;
use App\Entities\Product;
use App\Entities\Rating;
use App\Entities\User;
use App\Report\ReportGeneralPdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
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
        Storage::disk('public')->put(date('Y-m-d-H-i-s').'reports.reportGeneral.pdf', $pdf);

        return $this->from('johannitaarango2@gmail.com')
            ->view('emails.report')
            ->attachData($pdf->output(), 'reports.reportGeneral.pdf');
    }
}

<?php

namespace App\Mail;

use App\Exports\ReportExcelDaily;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendEmailReportExcelDaily extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @return SendEmailReportExcelDaily
     */
    public function build()
    {
        return $this->from(config('app.emailReportFrom'))
            ->view('emails.report')
            ->attach(
                Excel::download(new ReportExcelDaily(), 'reporte.xlsx')
                    ->getFile(),
                ['as' => 'report.xlsx']
            );
    }
}

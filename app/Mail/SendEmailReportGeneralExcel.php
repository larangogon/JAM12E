<?php

namespace App\Mail;

use App\Exports\ReportGeneralExport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendEmailReportGeneralExcel extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @return SendEmailReportGeneralExcel
     */
    public function build()
    {
        return $this->from('johannitaarango2@gmail.com')
            ->view('emails.report')
            ->attach(
                Excel::download(new ReportGeneralExport, 'reporte.xlsx')
                    ->getFile(),
                ['as' => 'report.xlsx']
            );
    }
}

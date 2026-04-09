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
        $name = date('Y-m-d-H-i') . 'reporte.xlsx';
        Excel::store(new ReportGeneralExport(), $name);

        return $this->from(config('jam.email_report_from'))
            ->view('emails.report')
            ->attach(
                Excel::download(new ReportGeneralExport(), 'reporte.xlsx')
                    ->getFile(),
                ['as' => 'report.xlsx']
            );
    }
}

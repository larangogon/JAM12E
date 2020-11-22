<?php

namespace App\Mail;

use App\Exports\ReportProductsExport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendEmailReportProductExcel extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @return SendEmailReportProductExcel
     */
    public function build()
    {
        $name = date('Y-m-d-H-i') . 'reporte.xlsx';
        Excel::store(new ReportProductsExport(), $name);
        return $this->from('johannitaarango2@gmail.com')
            ->view('emails.report')
            ->attach(
                Excel::download(new ReportProductsExport(), 'reporteProduct.xlsx')
                    ->getFile(),
                ['as' => 'reporteProduct.xlsx']
            );
    }
}

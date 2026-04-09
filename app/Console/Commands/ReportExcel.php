<?php

namespace App\Console\Commands;

use App\Jobs\ProcessReportExcelDaily;
use Illuminate\Console\Command;

class ReportExcel extends Command
{
    protected $signature = 'report:excel';
    protected $description = 'Reporte diario en excel';

    public function handle(): void
    {
        logger()->channel('stack')->info('se ha enviado el reporte diario en excel');

        $details['email'] = config('jam.email_report_from');

        dispatch(new ProcessReportExcelDaily($details));
    }
}

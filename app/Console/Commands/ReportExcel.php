<?php

namespace App\Console\Commands;

use App\Jobs\ProcessReportExcelDaily;
use Illuminate\Console\Command;

class ReportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reporte diario en excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        logger()->channel('stack')
            ->info('se ha enviado el reporte diario en excel');

        $details['email'] = 'johannitaarango2@gmail.com';

        dispatch(new ProcessReportExcelDaily($details));
    }
}

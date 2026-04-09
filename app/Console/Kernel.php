<?php

namespace App\Console;

use App\Console\Commands\PaymentOrders;
use App\Console\Commands\ReportExcel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        PaymentOrders::class,
        ReportExcel::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('payment:orders')->everyMinute();
        $schedule->command('report:excel')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

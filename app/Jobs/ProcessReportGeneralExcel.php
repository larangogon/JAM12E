<?php

namespace App\Jobs;

use App\Mail\SendEmailReportGeneral;
use App\Mail\SendEmailReportGeneralExcel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessReportGeneralExcel implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $details;

    /**
     * ProcessReportGeneralExcel constructor.
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        $email = new SendEmailReportGeneralExcel();

        Mail::to($this->details['email'])->send($email);
    }
}

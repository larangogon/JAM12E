<?php

namespace App\Jobs;

use App\Mail\SendEmailReportExcelDaily;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessReportExcelDaily implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $details;

    /**
     * ProcessReportExcelDaily constructor.
     * @param $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        $email = new SendEmailReportExcelDaily();

        Mail::to($this->details['email'])->send($email);
    }
}

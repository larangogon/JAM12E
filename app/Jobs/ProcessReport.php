<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailReport;
use Illuminate\Support\Facades\Mail;

class ProcessReport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $details;
    protected $ordersx;

    /**
     * ProcessReport constructor.
     * @param array $details
     * @param Collection $ordersx
     */
    public function __construct(array $details, Collection $ordersx)
    {
        $this->details = $details;
        $this->ordersx = $ordersx;
    }

    public function handle()
    {
        $email = new SendEmailReport($this->ordersx);

        Mail::to($this->details['email'])->send($email);
    }
}

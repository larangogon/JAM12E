<?php

namespace App\Jobs;

use App\Mail\SendEmailReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessReport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $details;
    protected $orders;

    public function __construct(array $details, Collection $orders)
    {
        $this->details = $details;
        $this->orders = $orders;
    }

    public function handle(): void
    {
        $email = new SendEmailReport($this->orders);

        Mail::to($this->details['email'])->send($email);
    }
}

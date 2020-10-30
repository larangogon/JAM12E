<?php

namespace App\Jobs;

use App\Entities\Report;
use App\Entities\User;
use App\Notifications\Export;
use App\Notifications\FinishedExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ProcessReport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param Report $report
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Report $report)
    {
        dd($report->toArray());
        $report->created_by = auth()->user()->id;
        $report->save();
        $admin = User::with('roles' == 'Administrator')->get();
        dd($admin);
        Notification::send($admin, new Export($report));

        $user->notify(new FinishedExport());
    }
}

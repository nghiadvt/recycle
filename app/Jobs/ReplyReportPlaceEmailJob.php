<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReplyReportPlaceEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReplyReportPlaceEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $email;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->email)->send(new ReplyReportPlaceEmail($this->email));
            Log::info("ReplyReportPlaceEmailJob - Success");
        } catch (\Exception $err) {
            Log::error("ReplyReportPlaceEmailJob - Error", [$err]);
        }
    }
}

<?php

namespace App\Jobs;

use App\Mail\VisitNotificationMail;
use App\Models\MaintenanceContractVisitDay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVisitNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $visit;
    protected $message;
    protected $managerEmails;

    public function __construct(MaintenanceContractVisitDay $visit, string $message, array $managerEmails)
    {
        $this->visit = $visit;
        $this->message = $message;
        $this->managerEmails = $managerEmails;
    }

    public function handle()
    {
        // Mail::to('librasingh2812@gmail.com')->send(new VisitNotificationMail($this->visit, $this->message));
        Mail::to($this->managerEmails)->send(new VisitNotificationMail($this->visit, $this->message));
    }
}

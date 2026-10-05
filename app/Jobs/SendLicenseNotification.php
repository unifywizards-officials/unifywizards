<?php

namespace App\Jobs;

use App\Mail\LicenseNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;



class SendLicenseNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $license;
    protected $type; // 'expiring_soon' or 'expired'

    public function __construct($license, $type)
    {
        $this->license = $license;
        $this->type = $type;
    }

    public function handle()
    {
        $subject = $this->type;
        $managerEmails = User::role('manager')->pluck('email')->toArray();     
       
        // Mail::to(['librasingh2812@gmail.com'])->send(new LicenseNotificationMail($this->license, $subject));
        Mail::to($managerEmails)->send(new LicenseNotificationMail($this->license, $subject));
    }
}

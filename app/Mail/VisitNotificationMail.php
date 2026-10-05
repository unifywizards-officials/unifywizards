<?php

namespace App\Mail;

use App\Models\MaintenanceContractVisitDay;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;
    public $message;

    public function __construct(MaintenanceContractVisitDay $visit, string $message)
    {
        $this->visit = $visit;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Maintenance Visit Notification')
                    ->markdown('emails.visit.visitNotification')
                    ->with([
                        'visit' => $this->visit,
                        'message' => $this->message,
                    ]);
    }
}

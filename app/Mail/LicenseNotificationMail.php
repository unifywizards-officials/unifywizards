<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\LicenseTracker; // Import the correct LicenseTracker model


class LicenseNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $license;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct(LicenseTracker $license, $subject)
    {
        $this->license = $license;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->markdown('emails.license.notification');
    }

    
}

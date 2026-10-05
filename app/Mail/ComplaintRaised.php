<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintRaised extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function build()
    {
        return $this->subject('New Complaint Raised')
        ->markdown('emails.complaint_raise')
        ->with([
            'complaint' => $this->complaint,
        ]);
       
    }
}
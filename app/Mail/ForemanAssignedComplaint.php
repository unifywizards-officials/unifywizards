<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForemanAssignedComplaint extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($complaint,$foreman)
    {
        $this->complaint = $complaint;
        $this->foreman = $foreman;
    }

    public function build()
    {
        return $this->subject('Complaint Assigned')
        ->markdown('emails.foreman_assigned_complaint')
        ->with([
            'complaint' => $this->complaint,
            'foreman' => $this->foreman,
        ]);
        
    }
}

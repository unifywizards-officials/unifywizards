<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OverTimeAddManager extends Mailable
{
    use Queueable, SerializesModels;

    public $overtime;

    public function __construct($overtime)
    {
        $this->overtime = $overtime;
    }

    public function build()
    {
        return $this->subject('Overtime Added')
        ->markdown('emails.overtimes.overtime_add_to_manager')
        ->with([
            'overtime' => $this->overtime,
        ]);
        
    }
}
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintConvertedTask extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->subject('New Task')
        ->markdown('emails.complaint_converted_task')
        ->with([
            'task' => $this->task,
        ]);
    }
}
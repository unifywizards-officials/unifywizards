<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $data;

    public function __construct($subjectLine, $data)
    {
        $this->subjectLine = $subjectLine;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.form-mail')
                    ->with([
                        'data' => $this->data,
                    ]);
    }
}
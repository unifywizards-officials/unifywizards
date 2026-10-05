<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;

    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {
        return $this->subject('Quote '.$this->quote->status)
        ->markdown('emails.quote_status_changed')
        ->with([
            'quote' => $this->quote,
        ]);
    }
}

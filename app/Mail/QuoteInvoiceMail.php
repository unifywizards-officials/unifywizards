<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoiceId;

    public function __construct($quote)
    {
        $this->quote = $quote;
    }

    public function build()
    {

        return $this->subject('Invoice for Quote '.$this->quote->title)
        ->markdown('emails.quote_invoice')
        ->with([
            'quote' => $this->quote,
        ]);
        
    }
}

<?php 
namespace App\Mail;

use App\Models\QuoteItem;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $quote;
    public $quoteItems;
    protected $filePath;

    public function __construct($quote, $filePath)
    {
        $this->quote = $quote;
        $this->quoteItems = QuoteItem::where('quote_id', $quote->id)->get();
        $this->filePath = $filePath;
    }

    public function build()
    {
       
        $email = $this->subject('New Quote Created')
        ->markdown('emails.quote_created')
        ->with([
            'quote' => $this->quote,
            'quoteItems' => $this->quoteItems,
        ]);              

        if (file_exists($this->filePath)) {
            $email->attach($this->filePath, [
                'as' => 'Invoice.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}

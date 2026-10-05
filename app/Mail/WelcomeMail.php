<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;

        // Generate a password reset link
        $this->resetUrl = URL::temporarySignedRoute(
            'password.reset', 
            Carbon::now()->addMinutes(60), 
            ['token' => app('auth.password.broker')->createToken($this->user)]
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to FMD',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.welcome', // Use 'markdown' instead of 'view'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

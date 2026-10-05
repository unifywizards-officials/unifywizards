<?php

namespace App\Services;

use App\Mail\FormSubmissionMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailService
{
    public static function sendFormMail($subject, $data, $to = null)
    {
        // Agar 'to' na diya ho to admin/from address par bhej do
        $to = $to ?: config('mail.from.address');

        try {
            Mail::to($to)->send(new FormSubmissionMail($subject, $data));
            return true;
        } catch (\Throwable $e) {
            // Error ko log file mein likho taaki pata chale asli wajah
            Log::error('Mail sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
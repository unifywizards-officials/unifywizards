<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\MailService;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'conName'    => 'required|max:255',
            'conEmail'   => 'required|email|max:255',
            'conPhone'   => 'required|max:20',
            'conSubject' => 'nullable|max:255',
            'conMessage' => 'required',
        ]);

        try {
            // 1. Database mein save
            Contact::create([
                'full_name'  => $request->conName,
                'email'      => $request->conEmail,
                'phone'      => $request->conPhone,
                'subject'    => $request->conSubject,
                'message'    => $request->conMessage,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // 2. Email send
            $sent = MailService::sendFormMail(
                'Contact Form Submission',
                [
                    'Name'    => $request->conName,
                    'Email'   => $request->conEmail,
                    'Phone'   => $request->conPhone,
                    'Subject' => $request->conSubject ?: 'N/A',
                    'Message' => $request->conMessage,
                ]
            );

            if (! $sent) {
                return back()->with(
                    'error',
                    'Message saved but email could not be sent. Please check mail settings.'
                );
            }

            return back()->with(
                'success',
                'Thank you! Your message has been submitted successfully.'
            );

        } catch (\Throwable $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
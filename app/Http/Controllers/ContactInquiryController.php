<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use App\Services\MailService;

class ContactInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'subject'   => 'nullable|string|max:255',
            'message'   => 'required|string|max:5000',
        ]);

        ContactInquiry::create([
            'full_name' => strip_tags($validated['full_name']),
            'email'     => strip_tags($validated['email']),
            'phone'     => strip_tags($validated['phone']),
            'subject'   => strip_tags($validated['subject'] ?? ''),
            'message'   => strip_tags($validated['message']),
            'ip_address'=> $request->ip(),
            'user_agent'=> $request->userAgent(),
        ]);

        MailService::sendFormMail(
            'New Inquiry Submission',
            [
                'Full Name' => $validated['full_name'],
                'Email'     => $validated['email'],
                'Phone'     => $validated['phone'],
                'Subject'   => $validated['subject'] ?? 'N/A',
                'Message'   => $validated['message'],
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully.',
        ]);
    }
}
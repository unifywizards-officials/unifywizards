<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use App\Services\MailService;

class NewsletterSubscriberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'email' => 'required|email|unique:newsletter_subscribers,email',

         
        ]);

        NewsletterSubscriber::create([

            'email' => $request->email,

            
        ]);

        MailService::sendFormMail(
        'New Newsletter Subscriber',
        [
            'Email' => $request->email,
        ]
    );

        return response()->json([

            'status' => true,

            'message' => 'Subscribed Successfully.'

        ]);
    }
}
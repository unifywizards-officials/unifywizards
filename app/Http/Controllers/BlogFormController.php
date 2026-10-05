<?php

namespace App\Http\Controllers;

use App\Models\BlogForm;
use Illuminate\Http\Request;
use App\Services\MailService;

class BlogFormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'service' => 'required|string|max:255',
            'message' => 'nullable|string',
            'blog_ref'=> 'nullable|string|max:255',
        ]);

        BlogForm::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'service'  => $request->service,
            'message'  => $request->message,
            'blog_ref' => $request->blog_ref,
        ]);

        MailService::sendFormMail(
        'New Blog Lead',
        [
            'Name'     => $request->name,
            'Email'    => $request->email,
            'Phone'    => $request->phone,
            'Service'  => $request->service,
            'Message'  => $request->message,
            'Blog Ref' => $request->blog_ref,
        ]
    );

        return back()->with('success', 'Thank you! We will contact you within 24 hours');
    }
}
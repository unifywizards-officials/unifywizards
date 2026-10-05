<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactProposal;
use App\Services\MailService;

class ContactProposalController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'first_name' => 'nullable|string|max:255',

            'last_name' => 'nullable|string|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'nullable|string|max:30',

            'website_url' => 'nullable|string|max:255',

            'looking_for' => 'nullable|string|max:255',

            'business_challenges' => 'nullable|string',

            'source' => 'nullable|string|max:100',

            'message' => 'nullable|string',

        ]);


        ContactProposal::create([

            'first_name' => $request->first_name,

            'last_name' => $request->last_name,

            'email' => $request->email,

            'phone' => $request->phone,

            'website_url' => $request->website_url,

            'looking_for' => $request->looking_for,

            'business_challenges' => $request->business_challenges,

            'source' => $request->source,

            'message' => $request->message,

        ]);

        MailService::sendFormMail(
            'New Proposal Submission',
            [
                'First Name' => $request->first_name ?: 'N/A',
                'Last Name'  => $request->last_name ?: 'N/A',
                'Email'      => $request->email,
                'Phone'      => $request->phone ?: 'N/A',
                'Website URL' => $request->website_url ?: 'N/A',
                'Looking For' => $request->looking_for ?: 'N/A',
                'Business Challenges' => $request->business_challenges ?: 'N/A',
                'Source'     => $request->source ?: 'N/A',
                'Message'    => $request->message ?: 'N/A',
            ]
        );

        return response()->json([

            'status' => true,

            'message' => 'Proposal submitted successfully.'

        ]);
    }
}

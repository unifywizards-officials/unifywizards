<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactProposal extends Model
{
    protected $fillable = [

        'first_name',

        'last_name',

        'email',

        'phone',

        'website_url',

        'looking_for',

        'business_challenges',

        'source',

        'message',

    ];
}

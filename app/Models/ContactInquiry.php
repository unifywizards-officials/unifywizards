<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = [

        'full_name',
        'email',
        'phone',
        'subject',
        'message',
        'ip_address',
        'user_agent',
        'is_read',
    ];
}
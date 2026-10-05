<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'header_logo',
        'footer_logo',
        'favicon',
        'dark_footer_logo1',
        'dark_footer_logo2',
        'footer_description',
        'footer_email',
        'footer_number',
        'location',
        'google_map_embed',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingSection extends Model
{
    protected $fillable = [
        'title',
        'highlight_text',
        'description',
        'link_text',
        'link_url',
        'tabs',
        'status',
    ];

    protected $casts = [
        'tabs' => 'array',
    ];
}
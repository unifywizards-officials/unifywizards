<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePricing extends Model
{
    protected $fillable = [

        'sub_title',
        'title',
        'highlight_text',
        'pricing_cards',
        'status',
    ];

    protected $casts = [

        'pricing_cards' => 'array',
    ];
}
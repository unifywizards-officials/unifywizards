<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePortfolio extends Model
{
    protected $fillable = [

        'sub_title',
        'title',
        'highlight_text',
        'description',
        'button_text',
        'button_link',
        'projects_json',
        'status',

    ];

    protected $casts = [

        'projects_json' => 'array',

    ];
}
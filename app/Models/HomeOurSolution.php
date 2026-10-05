<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeOurSolution extends Model
{
    protected $table = 'home_our_solutions';

    protected $fillable = [

        'sub_title',
        'title',
        'highlight_text',

        'services',

        'bottom_text',
        'bottom_button_text',
        'bottom_button_link',

        'status',
    ];

    protected $casts = [

        'services' => 'array',
    ];
}